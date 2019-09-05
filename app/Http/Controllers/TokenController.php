<?php

namespace App\Http\Controllers;

use App\Exceptions\AlreadyUsedTokenException;
use App\Exceptions\TokenExpiredException;
use App\Order;
use App\Token;
use App\TokenForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Kris\LaravelFormBuilder\FormBuilder;

class TokenController extends Controller
{
	public function index()
	{
		$user = Auth::user();

		if ($user->admin) {
			$tokens = Token::with(['user'])->get();
		} else {
			$tokens = $user->tokens()->with(['user'])->get();
		}

		return view('tokens.index', compact('tokens'));
	}

	public function show(Token $token)
	{
		return view('tokens.show', compact('token'));
	}

	public function use(Token $token)
	{
		if ($token->order !== null)
			throw new AlreadyUsedTokenException('Token already used.');

		if ($token->expires_at->isPast())
			throw new TokenExpiredException('Expired tokens cannot be used');

		$order = Order::make();

		$order->id = 'to' . $token->id;
		$order->duration = $token->duration;

		$order->paid = true;
		$order->canceled = false;

		$order->user()->associate(Auth::user());

		$order->recheck();

		$token->order()->associate($order);

		$token->save();

		flash()->success('Token registrado com sucesso!');

		return redirect()->route('orders.show', $order);
	}

	public function create(FormBuilder $builder)
	{
		$form = $builder->create(TokenForm::class, [
			'method' => 'POST',
			'url'    => route('tokens.store'),
		]);

		return view('form', [
			'title'       => 'Criando novo token',
			'form'        => $form,
			'submit_text' => 'Criar',
		]);
	}

	public function store(Request $request)
	{
		$validation = Validator::make($request->all(), [
			'id'         => 'required|alpha_num',
			'duration'   => 'required|numeric',
			'expires_at' => 'after:now',
		]);

		if ($validation->fails())
			// TODO: return as error (this is status code 200)
			return $validation->errors()->toJson();

		$token = Token::create($request->all());

		return redirect()->route('tokens.show', $token);
	}

	public function update(Request $request, Token $token)
	{
		$token->fill($request->all());

		$token->save();

		return $token;
	}

	public function destroy(Token $token)
	{
		$token->delete();

		return $token;
	}
}
