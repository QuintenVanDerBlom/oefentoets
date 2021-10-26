<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use \Pest\Laravel;

beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->order = Order::factory()->create();
});

test('an order update requires an user', function () {
    $admin = User::find(3);
    $this->actingAs($admin);
    $order = Order::factory()->make(['user_id' => 1, 'orderdate' => Carbon::now()->toDateTimeString()]);
    $this->patchJson(route('orders.update', ['order' => $this->order->id]),
        ['user_id' => null, 'orderdate' => $order->orderdate])->assertStatus(422);
})->group('OrderUpdateCheck');

test('an user id must be an integer', function () {
    $admin = User::find(3);
    $this->actingAs($admin);
    $order = Order::factory()->make(['user_id' => 1, 'orderdate' => Carbon::now()->toDateTimeString()]);
    $this->patchJson(route('orders.update', ['order' => $this->order->id]),
        ['user_id' => 'bla', 'orderdate' => $order->orderdate])->assertStatus(422);
})->group('OrderUpdateCheck');

test('an order requires a orderdate', function () {
    $admin = User::find(3);
    $this->actingAs($admin);
    $order = Order::factory()->make(['user_id' => 1, 'orderdate' => Carbon::now()->toDateTimeString()]);
    $this->patchJson(route('orders.update', ['order' => $this->order->id]),
        ['user_id' => 2, 'orderdate' => null])->assertStatus(422);
})->group('OrderUpdateCheck');
