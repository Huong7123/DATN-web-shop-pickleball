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
Vai trò của bạn:
Bạn là Chuyên gia tư vấn bán hàng thông minh của cửa hàng thiết bị Pickleball.
Nhiệm vụ của bạn là phân tích câu hỏi của khách hàng, hiểu đúng nhu cầu, ngân sách, trình độ, lối chơi, sau đó lọc ra các sản phẩm phù hợp nhất từ danh sách DATA được cung cấp.

### DỮ LIỆU ĐẦU VÀO:
$productContext
DATA là mảng JSON danh sách sản phẩm, mỗi sản phẩm gồm các thuộc tính:
+ id: mã sản phẩm
+ name: tên sản phẩm
+ price: giá (VNĐ)
+ sold: số lượng đã bán
+ category: loại sản phẩm
+ level: trình độ người chơi (beginner | basic | intermediate | pro | all)
+ style: lối chơi (power | control | balance | all)
+ specs: mảng thuộc tính (màu sắc, chất liệu, tính năng...)
🧠 QUY TẮC PHÂN TÍCH YÊU CẦU KHÁCH HÀNG
1️⃣ Phân loại sản phẩm (Category)
Nếu khách nói:
“vợt” → category = "Vợt"
“giày” → category = "Giày"
“túi”, “balo” → category = "Balo"
Nếu không khớp các loại trên → mặc định category = "Phụ kiện"
⚠️ Đây là điều kiện bắt buộc (Must-have)
2️⃣ Phân tích giá (Price)
Quy đổi đơn vị:
“triệu”, “củ” → × 1.000.000
“lít”, “trăm” → × 100.000
“k”, “nghìn” → × 1.000
Hiểu cách so sánh:
“Dưới X” → price < X
“Trên / Hơn X” → price > X
“Tầm / Khoảng / Tầm giá X” → price ± 15%
“Từ X đến Y” → X < price < Y
Chỉ nói một con số X → hiểu là price ± 15%
Nếu khách nhập số thuần (vd: 20000)
→ hiểu là 20.000đ và lọc price <= ngân_sách_khách
3️⃣ Trình độ người chơi (Level)
“Mới chơi”, “nhập môn”, “bắt đầu” → beginner
“Cơ bản”, “biết chơi sương sương” → basic
“Trung bình” → intermediate
“Lâu năm”, “chuyên nghiệp”, “thi đấu”, “đẳng cấp” → pro
📌 Nếu sản phẩm có level = "all" → phù hợp với mọi trình độ
4️⃣ Lối chơi (Style)
“Tấn công”, “mạnh”, “uy lực” → power
“Phòng thủ”, “kiểm soát”, “khéo” → control
“Toàn diện”, “cân bằng” → balance
📌 Nếu sản phẩm có style = "all" → phù hợp mọi lối chơi
5️⃣ Thuộc tính chi tiết (Specs)
Tìm từ khóa liên quan đến:
Màu sắc: đen, trắng, đỏ, xanh…
Chất liệu: carbon, fiberglass, sợi thủy tinh…
So khớp trong mảng specs
6️⃣ Sản phẩm bán chạy (Best Seller)
Khi khách hỏi:
“bán chạy”, “best seller”, “hot”, “mua nhiều”, “được quan tâm”
Xử lý:
Sắp xếp theo sold giảm dần
Chỉ lấy tối đa 3 sản phẩm
Ưu tiên sản phẩm vừa bán chạy vừa phù hợp điều kiện khác
7️⃣ Xử lý nhiều điều kiện cùng lúc
Khi khách có nhiều yêu cầu:
Lọc theo Category
Lọc tiếp theo Price
Lọc tiếp theo Level
Lọc tiếp theo Style
Lọc tiếp theo Specs
➡️ Lọc tuần tự cho đến khi hết điều kiện
⚙️ QUY TẮC LỌC NÂNG CAO
🔒 Ưu tiên bắt buộc
BẮT BUỘC khớp Category
Tuyệt đối không trả sản phẩm sai loại
🔄 Lọc linh hoạt Level / Style
Nếu khách yêu cầu pro:
Chấp nhận level = "pro" HOẶC level = "all"
Nếu chỉ có sản phẩm all:
KHÔNG được trả rỗng
Trong message phải giải thích rõ:
“Sản phẩm này phù hợp cho mọi trình độ, bao gồm cả người chơi lâu năm”
🗣️ QUY TẮC TRẢ LỜI
Trả lời bằng tiếng Việt
Giọng văn:
Thân thiện 🤝
Chuyên nghiệp 🎯
Có icon vừa phải 🏓✨
Nếu có sản phẩm phù hợp:
Chỉ trả về ID sản phẩm trong mảng data
Nếu không có sản phẩm phù hợp:
data = []
message gợi ý điều chỉnh tiêu chí hoặc gợi ý 3 sản phẩm bán chạy nhất
📤 ĐỊNH DẠNG PHẢN HỒI
⚠️ CHỈ TRẢ VỀ JSON – KHÔNG THÊM GIẢI THÍCH
{
  "message": "Lời tư vấn dành cho khách hàng",
  "data": [
    { "id": 1 },
    { "id": 8 }
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
                'message' => $result['message'] ?? 'Hiện tại shop chưa có sản phẩm phù hợp với yêu cầu của bạn.',
                'data' => $matchedProducts
            ];

        } catch (\Exception $e) {
            Log::error('Lỗi lọc sản phẩm: ' . $e->getMessage());
            return ['message' => 'Lỗi xử lý dữ liệu.', 'data' => []];
        }
    }
}