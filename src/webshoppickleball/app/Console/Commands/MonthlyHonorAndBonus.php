<?php

namespace App\Console\Commands;

use App\Services\Backend\SaleService;
use Illuminate\Console\Command;

class MonthlyHonorAndBonus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:monthly-honor-and-bonus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    protected SaleService $saleService;

    public function __construct(SaleService $saleService)
    {
        parent::__construct();
        $this->saleService = $saleService;
    }

    public function handle(): int
    {
        $this->info('Bắt đầu chạy vinh danh & tính thưởng theo tháng...');

        $result = $this->saleService->check();

        if (empty($result)) {
            $this->warn('Không có NPP nào đạt điều kiện');
            return Command::SUCCESS;
        }

        foreach ($result as $item) {
            $this->line(
                "NPP: {$item['npp']} | Thưởng: " .
                number_format($item['bonus']) . ' VND'
            );
        }

        $this->info('Hoàn thành tính thưởng.');

        return Command::SUCCESS;
    }
}
