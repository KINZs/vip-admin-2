<?php

namespace App\Listeners;

use App\Events\NewAffiliateToken;
use App\Events\OrderPaid;
use App\Token;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GeneratePaidOrderAffiliateToken
{
	/**
	 * Handle the event.
	 *
	 * @param OrderPaid $event
	 *
	 * @return void
	 */
	public function handle(OrderPaid $event)
	{
		$order = $event->order;

		$client = $order->user;

		$affiliate = $client->referrer;

		if ($affiliate) {
			$token = Token::make();

			$token->id = random_id(20);
			$token->duration = round($order->duration / 2);
			$token->note = "Token de afiliado gerado pelo pedido $order->id";
			$token->user()->associate($affiliate);
			$token->reason()->associate($order);

			$token->save();

			event(new NewAffiliateToken($token));
		}
	}
}