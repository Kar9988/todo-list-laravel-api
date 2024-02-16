<?php

namespace App\Services;

use App\Http\Resources\CardsResource;
use App\Models\Card;
use Carbon\Carbon;

class CardService
{
    public function createCard(array $data): CardsResource
    {
        $card = Card::create($data);

        return new CardsResource($card);
    }

    public function timerOn(int $id): void
    {
        Card::where('id', $id)
            ->update([
                'tracker_started' => now(),
                'tracker_active'  => true
            ]);
    }

    public function timerOff(int $id): void
    {
        $card = Card::where('id', $id)->first();
        $card->update([
            'tracker_started' => null,
            'tracker'         => ($card->tracker??0)+Carbon::now()->diffInSeconds($card->tracker_started),
            'tracker_active'  => false
        ]);
    }
}
