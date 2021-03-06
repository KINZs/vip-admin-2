<?php

// Login
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Início', route('home'));
});
// Login
Breadcrumbs::for('login', function ($trail) {
    $trail->push('Login', route('login'));
});
// Search
Breadcrumbs::for('search', function ($trail) {
    $trail->push('Busca', route('home'));
});

// Settings
Breadcrumbs::for('settings', function ($trail) {
    $trail->parent('home');
    $trail->push('Configurações', route('settings'));
});

// Settings
Breadcrumbs::for('faq', function ($trail) {
    $trail->parent('home');
    $trail->push('Perguntas frequentes', route('faq'));
});

// Products
Breadcrumbs::for('products.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Produtos', route('products.index'));
});

// Products > Store
Breadcrumbs::for('products.create', function ($trail) {
    $trail->parent('products.index');
    $trail->push('Criando produto', route('products.create'));
});

// Products > Update
Breadcrumbs::for('products.edit', function ($trail, $product) {
    $trail->parent('products.index');
    $trail->push('Atualizando produto', route('products.edit', $product));
});

// Affiliates
Breadcrumbs::for('affiliates.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Afiliados', route('affiliates.index'));
});

// Admins
Breadcrumbs::for('admins.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Admins', route('admins.index'));
});

// Admins > Create
Breadcrumbs::for('admins.create', function ($trail) {
    $trail->parent('admins.index');
    $trail->push('Adicionando novo admin', route('admins.create'));
});

// Admins > Edit
Breadcrumbs::for('admins.edit', function ($trail, $admin) {
    $trail->parent('admins.index');
    $trail->push('Editando admin', route('admins.edit', $admin));
});

// Orders
Breadcrumbs::for('orders.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Pedidos', route('orders.index'));
});

// Orders > Show
Breadcrumbs::for('orders.show', function ($trail, $order) {
    $trail->parent('orders.index');
    $trail->push("Pedido #$order->id", route('orders.show', $order));
});

// Orders > Edit
Breadcrumbs::for('orders.edit', function ($trail, $order) {
    $trail->parent('orders.show', $order);
    $trail->push("Editando pedido #$order->id", route('orders.edit', $order));
});

// Orders > Gift
Breadcrumbs::for('orders.gift', function ($trail, $order) {
    $trail->parent('orders.show', $order);
    $trail->push("Transferir pedido", route('orders.gift', $order));
});

// Orders > Create
Breadcrumbs::for('orders.create', function ($trail, $duration) {
    $trail->parent('orders.index');
    $trail->push("Transferir pedido", route('orders.create', $duration));
});

// Tokens
Breadcrumbs::for('tokens.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Tokens', route('tokens.index'));
});

// Tokens > Create
Breadcrumbs::for('tokens.create', function ($trail) {
    $trail->parent('tokens.index');
    $trail->push('Criando tokens', route('tokens.create'));
});

// Tokens > Show
Breadcrumbs::for('tokens.show', function ($trail, $token) {
    $trail->parent('tokens.index');
    $trail->push('Vendo token', route('tokens.show', $token));
});

// Users
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Usuários', route('users.index'));
});

// Users > Show
Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push($user->name ?? $user->username, route('users.show', $user));
});

// Coupons
Breadcrumbs::for('coupons.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Cupons', route('coupons.index'));
});

// Coupons > Create
Breadcrumbs::for('coupons.create', function ($trail) {
    $trail->parent('coupons.index');
    $trail->push('Criando cupom', route('coupons.create'));
});

// Coupons > Create
Breadcrumbs::for('coupons.edit', function ($trail, $coupon) {
    $trail->parent('coupons.index');
    $trail->push("Editando cupom {$coupon->code}", route('coupons.edit', $coupon));
});
