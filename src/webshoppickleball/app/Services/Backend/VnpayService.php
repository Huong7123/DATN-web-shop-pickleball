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
        $transactionId = date('YmdHis');

        /** @var VnPayRepositoryInterface $repo */
        $repo = $this->repository;

        $transaction = $repo->create([
            'transaction_id' => $transactionId,
            'amount' => $data['amount'],
            'status' => 'pending',
            'payment_method' => 'vnpay',
            'vnp_create_date' => date('YmdHis'),
            'payload' => json_encode([
                'vnp_Amount' => $data['amount'],
                'vnp_TxnRef' => $transactionId
            ]),
        ]);

        return new DataResult('Tạo URL thanh toán thành công', 201, [
            'payment_url' => route('vnpay.redirect', ['txn' => $transactionId]),
            'transaction' => $transaction
        ]);
    }

    public function handleReturn(array $params): DataResult
    {
        $txn = $params['vnp_TxnRef'] ?? null;

        /** @var VnPayRepositoryInterface $repo */
        $repo = $this->repository;
        $payment = $repo->findByTransactionId($txn);

        if (!$payment) {
            return new DataResult('Không tìm thấy giao dịch', 404);
        }

        $status = ($params['vnp_ResponseCode'] ?? '') == '00'
            ? 'success'
            : 'failed';

        $repo->update($payment->id, [
            'status' => $status,
            'vnp_response_code' => $params['vnp_ResponseCode'] ?? null,
            'bank_code' => $params['vnp_BankCode'] ?? null,
            'payload' => json_encode($params),
        ]);

        return new DataResult('Xử lý giao dịch thành công', 200, [
            'transaction' => $payment->refresh()
        ]);
    }

    public function buildVnpayRedirectUrl(string $txn): DataResult
    {
        /** @var VnPayRepositoryInterface $repo */
        $repo = $this->repository;

        // Lấy thông tin giao dịch
        $payment = $repo->findByTransactionId($txn);
        if (!$payment) {
            return new DataResult('Không tìm thấy giao dịch', 404);
        }

        $vnpUrl        = config('vnpay.vnp_Url');        // https://sandbox.vnpayment.vn/paymentv2/vpcpay.html
        $vnpTmnCode    = config('vnpay.vnp_TmnCode');    // Mã merchant
        $vnpHashSecret = config('vnpay.vnp_HashSecret'); // Chuỗi bí mật
        $vnpReturnUrl  = config('vnpay.vnp_ReturnUrl');  // URL trả về

        // Chuẩn hóa thông tin
        $amount = intval($payment->amount) * 100; // nhân 100 theo yêu cầu VNPAY
        $orderInfo = str_replace(' ', '_', "Thanh toan don hang " . $payment->transaction_id);
        $clientIp = '127.0.0.1'; // Sandbox luôn dùng được IP này

        $params = [
            "vnp_Version"    => "2.1.0",
            "vnp_Command"    => "pay",
            "vnp_TmnCode"    => $vnpTmnCode,
            "vnp_Amount"     => (string)$amount,
            "vnp_TxnRef"     => $payment->transaction_id,
            "vnp_OrderInfo"  => $orderInfo,
            "vnp_OrderType"  => "other",
            "vnp_ReturnUrl"  => $vnpReturnUrl,
            "vnp_IpAddr"     => $clientIp,
            "vnp_CreateDate" => $payment->vnp_create_date,
            "vnp_CurrCode"   => "VND",
            "vnp_Locale"     => "vn",
        ];

        // Sắp xếp key theo thứ tự tăng dần
        ksort($params);

        // Tạo chuỗi hash: key=value nối bằng &
        $hashData = [];
        foreach ($params as $key => $value) {
            $hashData[] = $key . '=' . $value;
        }
        $hashString = implode('&', $hashData);

        // Sinh chữ ký
        $secureHash = hash_hmac('sha512', $hashString, $vnpHashSecret);

        // Build URL cuối cùng (encode value)
        $query = [];
        foreach ($params as $key => $value) {
            $query[] = $key . '=' . urlencode($value);
        }
        $redirectUrl = $vnpUrl . '?' . implode('&', $query) . '&vnp_SecureHash=' . $secureHash;

        return new DataResult('Tạo URL thành công', 200, [
            'redirect_url' => $redirectUrl
        ]);
    }

    
}