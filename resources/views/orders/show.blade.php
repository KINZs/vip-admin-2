@extends('layouts.app')

@section('content')
    <h1 class="text-center">Pedido <code>#{{ $order->id }}</code></h1>
    <br/>
    @component('partials.card')
        @slot('title')
            <div class="d-flex items-center justify-between">
                <span>Detalhes</span>
                <div class="btn-group">
                    <a class="btn btn-primary btn-sm" href="{{ route('orders.gift', $order) }}">Transferir</a>
                    @admin
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('orders.edit', $order) }}">Editar</a>
                    @endadmin
                </div>
            </div>
        @endslot
        <table class="table">
            <tbody>
            <tr>
                <td>ID</td>
                <td><code>#{{ $order->id }}</code></td>
            </tr>
            <tr>
                <td>Ref.</td>
                <td><code>#{{ $order->reference }}</code></td>
            </tr>
            <tr>
                <td>Duração</td>
                <td><span class="badge badge-primary">{{ $order->duration }} dias</span></td>
            </tr>
            <tr>
                <td>Restante</td>
                <td>
                    @if($remaining = $order->remaining)
                        <span class="badge badge-primary">
                            {{ $remaining }}
                            {{ $remaining === 1 ? 'dia' : 'dias' }}
                        </span>
                    @else
                        <span class="badge badge-secondary">N/A</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Estado</td>
                <td>
                    @include('orders.status-badge')
                </td>
            </tr>
            <tr>
                <td>Transferido</td>
                <td>
                    @if($order->steamid)
                        <span class="badge badge-primary">{{ $order->steamid }}</span>
                    @else
                        <span class="badge badge-dark">Não</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Criado em</td>
                <td>
                    {{ $order->created_at->diffForHumans() }}
                    <small class="text-xs text-gray-500 font-light tracking-tight">{{ $order->created_at }}</small>
                </td>
            </tr>
            @if($order->paid && $order->activated)
                <tr>
                    <td>Início</td>
                    <td>
                        {{ $order->starts_at->diffForHumans() }}
                        <small class="text-xs text-gray-500 font-light tracking-tight">{{ $order->starts_at }}</small>
                    </td>
                </tr>
                <tr>
                    <td>Termina em</td>
                    <td>
                        {{ $order->ends_at->diffForHumans() }}
                        <small class="text-xs text-gray-500 font-light tracking-tight">{{ $order->ends_at }}</small>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>

        @if(!$order->activated && !$order->paid && !$order->canceled)
            <a class="btn btn-outline-primary btn-block btn-lg" href="{{ $order->init_point }}">Pagar</a>
        @endif

        @if(!$order->activated && $order->paid)
            {!! Form::open(['url' => route('orders.activate', $order), 'method' => 'PATCH']) !!}
            <button class="btn btn-success btn-block btn-lg">Ativar</button>
            {!! Form::close() !!}
        @endif
    @endcomponent


@endsection
