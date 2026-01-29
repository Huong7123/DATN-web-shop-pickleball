<?php

namespace App\Console\Commands;

use App\Services\Backend\OfferService;
use Illuminate\Console\Command;

class CreateOffer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-offer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron job tạo mã ưu đãi độc quyền';

    /**
     * Execute the console command.
     */
    public function handle(OfferService $service)
    {
        $this->info('Đang bắt đầu quá trình quét User...');
        
        $service->scanAndGrantRewards();
        
        $this->info('Hoàn tất quá trình tạo mã ưu đãi độc quyền!');
    }
}
