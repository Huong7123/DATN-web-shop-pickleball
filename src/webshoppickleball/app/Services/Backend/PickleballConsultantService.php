<?php

namespace App\Services\Backend;

use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class PickleballConsultantService
{
    protected ProductRepositoryInterface $productRepo;
    protected Gemini15Service $gemini;

    public function __construct(
        ProductRepositoryInterface $productRepo,
        Gemini15Service $gemini
    ) {
        $this->productRepo = $productRepo;
        $this->gemini = $gemini;
    }

    public function consult(string $userMessage): array
    {
        $products = $this->productRepo->getActiveProductsForConsulting();

        if ($products->isEmpty()) {
            return ['message' => 'Hiện tại shop đang cập nhật sản phẩm mới!', 'data' => []];
        }

        // 1. Chuẩn hóa dữ liệu gửi cho AI
        $simplifiedData = $products->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'price' => (float) $p->price,
                'sold' => (int)$p->sold,
                'category' => $p->category->name ?? '',
                'level' => $p->level, 
                'style' => $p->play_style, 
                'specs' => collect($p->attribute_values)->pluck('name')->all(), 
            ];
        });

        $productContext = json_encode($simplifiedData, JSON_UNESCAPED_UNICODE);
        //dd($productContext);
        // 2. System Prompt
        $systemPrompt = <<<SYS
Bạn là Chuyên gia tư vấn bán hàng thông minh của cửa hàng thiết bị Pickleball. 
Nhiệm vụ của bạn là phân tích câu hỏi của khách hàng và lọc ra các sản phẩm phù hợp nhất từ danh sách DATA được cung cấp.

### DỮ LIỆU ĐẦU VÀO:
$productContext
- DATA là danh sách sản phẩm JSON gồm: id, name, price, category, level (trình độ), style (lối chơi), specs (màu sắc, chất liệu, tính năng).

### QUY TẮC PHÂN TÍCH HÀNH VI:
1. **Phân loại (Category):** Nếu khách nói "vợt", "giày", "túi", hãy lọc theo trường 'category'.
2. **Giá cả (Price):** - Hiểu các thuật ngữ: "củ", "triệu" = 1.000.000; "lít", "trăm" = 100.000; "k", "nghìn" = 1.000.
   - So sánh toán học: "Dưới X" là price < X; "Trên/Hơn X" là price > X; "Tầm/Khoảng/Tầm giá/Khoảng giá X" là price +/- 15%; "Từ X đến Y" là X < price < Y.
3. **Trình độ (Level):**
   - "Mới chơi", "nhập môn", "bắt đầu" = 'beginner'.
   - "Cơ bản", "biết chơi hơi hơi", "biết chơi sương sương" = 'basic'
   - "Trung bình" = 'intermediate'
   - "Chuyên nghiệp", "thi đấu", "lâu năm", "đẳng cấp" = 'pro'.
4. **Lối chơi (Style):**
   - "Tấn công", "mạnh mẽ", "uy lực" = 'power'.
   - "Phòng thủ", "kiểm soát", "khéo léo" = 'control'.
   - "toàn diện", "cân bằng" = 'balance
5. **Thuộc tính (Specs):** Tìm kiếm màu sắc (đen, trắng, đỏ...) hoặc chất liệu (carbon, sợi thủy tinh...) trong mảng 'specs'.
6. **Sản phẩm bán chạy (Best Seller):** - Nếu khách hỏi "best seller", "bán chạy", "mua nhiều", "hot", "quan tâm" hãy dựa vào trường `sold`.
   - Phải ưu tiên đưa các sản phẩm có số `sold` cao nhất lên đầu và sắp xếp giảm dần.
   - Chỉ lấy tối đa 3 sản phẩm phù hợp nhất cho yêu cầu này.

### QUY TẮC TRẢ LỜI:
- Trình bày câu trả lời (message) bằng tiếng Việt thân thiện, chuyên nghiệp, có sử dụng icon. 
- Nếu có sản phẩm phù hợp: Liệt kê ID của chúng vào mảng 'data'.
- Nếu không có sản phẩm nào khớp: Mảng 'data' để rỗng [] và 'message' hãy khéo léo gợi ý khách hàng các tiêu chí khác hoặc mời khách liên hệ hotline.

### ĐỊNH DẠNG PHẢN HỒI (CHỈ TRẢ VỀ JSON):
{
  "message": "Lời tư vấn của bạn ở đây",
  "data": [
    {"id": 3},
    {"id": 5}
  ]
}
SYS;

        // 3. Gọi AI
        $rawResponse = $this->gemini->ask($systemPrompt . "\nDATA: " . $productContext, $userMessage);

        // 4. Xử lý kết quả (Sửa lỗi ép kiểu tại đây)
        try {
            $input = is_string($rawResponse) ? $rawResponse : json_encode($rawResponse);

            // Bóc tách khối JSON
            if (preg_match('/\{.*\}/s', $input, $matches)) {
                $jsonContent = $matches[0];
            } else {
                $jsonContent = $input;
            }

            $result = json_decode(trim($jsonContent), true);

            // LẤY ID VÀ ÉP KIỂU SỐ NGUYÊN NGAY LẬP TỨC
            $ids = collect($result['data'] ?? [])->pluck('id')->map(fn($id) => (int)$id)->toArray();

            // Lấy sản phẩm và giữ đúng thứ tự ưu tiên của AI (Sản phẩm bán nhiều nhất đứng đầu)
            $matchedProducts = collect($ids)->map(function($id) use ($products) {
                return $products->firstWhere('id', $id);
            })->filter()->values();

            // Debug thử nếu vẫn rỗng
            if ($matchedProducts->isEmpty() && !empty($ids)) {
                Log::info('ID tìm thấy nhưng không khớp sản phẩm:', ['ids' => $ids]);
            }

            return [
                'message' => $result['message'] ?? 'Tôi tìm thấy sản phẩm này cho bạn:',
                'data' => $matchedProducts
            ];

        } catch (\Exception $e) {
            Log::error('Lỗi lọc sản phẩm: ' . $e->getMessage());
            return ['message' => 'Lỗi xử lý dữ liệu.', 'data' => []];
        }
    }
}