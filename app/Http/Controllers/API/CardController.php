<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{

    private CardService $cardService;

    public function __construct(CardService $cardService)
    {

        $this->cardService = $cardService;
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['tracker_active'] = false;
        $card = $this->cardService->createCard($data);

        return response()->json([
            'success' => 1,
            'type'    => 'success',
            'card'    => $card
        ]);
    }

    public function timerOn($id): JsonResponse
    {
        $this->cardService->timerOn($id);

        return response()->json([
            'success' => 1,
            'type'    => 'success'
        ]);
    }

    public function timerOff($id): JsonResponse
    {
        $this->cardService->timerOff($id);

        return response()->json([
            'success' => 1,
            'type'    => 'success'
        ]);
    }
}
