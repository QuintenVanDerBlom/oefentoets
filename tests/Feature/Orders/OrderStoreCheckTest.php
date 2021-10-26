<?php

use App\Models\User;
use App\Models\Order;
use \Pest\Laravel;
use Carbon\Carbon;

beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->order = Order::factory()->create();
});

test('an order requires a user', function () {
    $admin = User::find(3);
    Laravel\be($admin);
    $order = Order::factory()->make(['user_id' => null, 'orderdate' => Carbon::now()->toDateTimeString()]);
    $this->postJson(route('orders.store'), $order->toArray())
        ->assertStatus(422);
})->group('OrderStoreCheck');

test('an user_id must be an integer', function () {
    $admin = User::find(3);
    Laravel\be($admin);
    $order = Order::factory()->make(['user_id' => 'bla', 'orderdate' => Carbon::now()->toDateTimeString()]);
    $this->postJson(route('orders.store'), $order->toArray())
        ->assertStatus(422);
})->group('OrderStoreCheck');

test('an order requires an orderdate', function () {
    $admin = User::find(3);
    Laravel\be($admin);
    $order = Order::factory()->make(['user_id' => 1, 'orderdate' => null]);
    $this->postJson(route('orders.store'), $order->toArray())
        ->assertStatus(422);
})->group('OrderStoreCheck');
