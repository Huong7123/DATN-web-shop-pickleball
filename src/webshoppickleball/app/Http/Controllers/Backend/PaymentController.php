<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Services\Backend\VnpayService;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
    public function __construct(VnpayService $service)
    {
        parent::__construct($service);
    }

    public function createPayUrl(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|integer|min:1000',
            'order_id' => 'required|integer|exists:orders,id',
        ]);

        /** @var VnpayService $ser */
        $ser = $this->service;

        $result = $ser->createPayUrl($data);

        return response()->json($result, $result->http_code);
    }

    public function returnVnpay(Request $request)
    {
        /** @var VnpayService $ser */
        $ser = $this->service;
        $result = $ser->handleReturn($request->all());

        if ($result->http_code === 200) {
            return redirect()->route('payment.success')
                ->with('transaction', $result->data['transaction']);
        }

        return redirect()->route('payment.failed')
            ->with('message', $result->message);
    }

    public function redirectToVnpay(string $txn)
    {
        /** @var VnpayService $ser */
        $ser = $this->service;

        return redirect()->away(
            $ser->buildVnpayRedirectUrl($txn)->data['redirect_url']
        );
    }

}
