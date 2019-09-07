<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderCreated as OrderCreatedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderCreatedMail
{
	/**
	 * Handle the event.
	 *
	 * @param  OrderCreated $event
	 *
	 * @return void
	 */
	public function handle(OrderCreated $event)
	{
		$order = $event->order;
		$user = $order->user;

		if ($user->email)
			Mail::to($user->email)->send(new OrderCreatedMail($order));
	}
}
