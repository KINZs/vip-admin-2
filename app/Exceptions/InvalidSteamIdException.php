<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidSteamIdException extends FlashException
{
	public function flash()
	{
		$message = e($this->message);
		flash()->error("<strong>$message</strong> não é uma SteamID válida!");
	}

	public function getResponse()
	{
		return back();
	}
}
