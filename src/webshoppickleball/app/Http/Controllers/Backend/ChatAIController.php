<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\PickleballConsultantService;
use Illuminate\Http\Request;

class ChatAIController extends Controller {
    protected $consultantService;

    public function __construct(PickleballConsultantService $consultantService) {
        $this->consultantService = $consultantService;
    }

    public function __invoke(Request $request) {
        $request->validate(['message' => 'required|string']);

        $answer = $this->consultantService->consult($request->message);

        return response()->json([
            'answer' => $answer
        ]);
    }
}
