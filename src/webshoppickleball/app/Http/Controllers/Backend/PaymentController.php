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
            return view('payment.payment-success', [
                'transaction' => $result->data['transaction']
            ]);
        }

        return view('payment.payment-failed', [
            'message' => $result->message
        ]);
    }

    public function redirectToVnpay(Request $request)
    {
        $txn = $request->query('txn');
        /** @var VnpayService $ser */
        $ser = $this->service;

        $result = $ser->buildVnpayRedirectUrl($txn);
        // dd($result);
        return redirect()->away($result->data['redirect_url']);
    }


    
}
