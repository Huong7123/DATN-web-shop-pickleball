<?php

namespace App\Services\Backend;

use App\Interfaces\ProductRepositoryInterface;
use App\Services\Backend\Gemini15Service;
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

        if ($products->isEmpty()) return [];

        $productContext = $products->map(fn($p) =>
            "ID:{$p->id} | {$p->name} | Price:{$p->price} | Level:{$p->level} | Style:{$p->play_style}"
        )->implode("\n");

        $systemPrompt = <<<SYS
Bạn là AI chọn vợt pickleball.

Chỉ được chọn trong danh sách dưới đây.
Chỉ trả JSON array các object:

[
    { "id": number }
]

Không thêm chữ khác. Không markdown. Không giải thích.

Nếu không có kết quả, trả [].

DANH SÁCH:
$productContext
SYS;

        $ids = $this->gemini->ask($systemPrompt, $userMessage);

        if (!$ids) return [];

        return $products->whereIn('id', collect($ids)->pluck('id'))->values()->toArray();
    }

}

