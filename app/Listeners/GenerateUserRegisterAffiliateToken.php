<?php

namespace App\Listeners;

use App\Events\NewAffiliateToken;
use App\Token;
use Illuminate\Auth\Events\Registered;

class GenerateUserRegisterAffiliateToken
{
    /**
     * Handle the event.
     *
     * @param Registered $event
     *
     * @return void
     */
    public function handle(Registered $event)
    {
        $client = $event->user;

        $affiliate = $client->referrer;

        if ($affiliate) {
            $token = new Token;

            $token->id = random_id(5);
            $token->duration = $affiliate->affiliate_register_duration;
            $token->note = "Token de afiliado gerado pelo registro de $client->username";
            $token->user()->associate($affiliate);
            $token->reason()->associate($client);

            $token->save();

            event(new NewAffiliateToken($token));
        }
    }
}
