<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\VnPayRepositoryInterface;

class VnpayService extends BaseService
{
    public function __construct(VnPayRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function createPayUrl(array $data): DataResult
    {
        $txn = date('YmdHis');

        $payment = $this->repository->create([
            'transaction_id' => $txn,
            'order_id'       => $data['order_id'],
            'amount' => $data['amount'],
            'status' => 'pending',
            'payment_method' => 'vnpay',
            'vnp_create_date' => $txn,
        ]);

        return new DataResult('OK', 201, [
            'payment_url' => route('vnpay.redirect', $txn),
            'transaction' => $payment
        ]);
    }

    public function buildVnpayRedirectUrl(string $txn): DataResult
    {
        /** @var VnPayRepositoryInterface $repo */
        $repo = $this->repository;
        $p = $repo->findByTransactionId($txn);
        if (!$p) return new DataResult('Not found', 404);

        $input = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => config('vnpay.tmn_code'),
            "vnp_Command" => "pay",
            "vnp_Amount" => (string)($p->amount * 100),
            "vnp_CurrCode" => "VND",
            "vnp_TxnRef" => $p->transaction_id,
            "vnp_OrderInfo" => "Thanh toan don #" . $p->transaction_id,
            "vnp_OrderType" => "other",
            "vnp_Locale" => "vn",
            "vnp_ReturnUrl" => config('vnpay.return_url'),
            "vnp_IpAddr" => request()->ip(),
            "vnp_CreateDate" => $p->vnp_create_date,
        ];

        ksort($input);

        $query = "";
        $i = 0;
        $hashData = "";
        foreach ($input as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = config('vnpay.url') . "?" . $query;
        $vnpSecureHash = hash_hmac('sha512', $hashData, config('vnpay.hash_secret'));
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        return new DataResult('OK', 200, [
            'redirect_url' => $vnp_Url
        ]);
    }

    public function handleReturn(array $input): DataResult
    {
        $vnp_SecureHash = $input['vnp_SecureHash'] ?? '';
        
        // Loại bỏ các tham số không tham gia tính toán hash
        unset($input['vnp_SecureHash']);
        unset($input['vnp_SecureHashType']);

        ksort($input);

        $i = 0;
        $hashData = "";
        foreach ($input as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, config('vnpay.hash_secret'));

        if ($secureHash !== $vnp_SecureHash) {
            return new DataResult('Sai chữ ký', 403);
        }

        /** @var VnPayRepositoryInterface $repo */
        $repo = $this->repository;
        $p = $repo->findByTransactionId($input['vnp_TxnRef']);
        if (!$p) return new DataResult('Không tìm thấy giao dịch', 404);

        $status = $input['vnp_ResponseCode'] === '00' ? 'success' : 'failed';
        $repo->update($p->id, ['status' => $status]);

        $transaction = $p->refresh()->load('order.items.product');

        return new DataResult('OK', 200, [
            'transaction' => $transaction,
            'order'       => $transaction->order
        ]);
    }
}
