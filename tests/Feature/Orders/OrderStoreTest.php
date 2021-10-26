<?php

use App\Models\User;
use App\Models\Order;
use \Pest\Laravel;
use Carbon\Carbon;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->order = Order::factory()->create();
});

test('guest can not create an order in the admin', function () {
    $this->postJson(route('orders.store'))
        ->assertStatus(401);
})->group('OrderStore');

test('customer can not create an order in the admin', function () {
    $customer = User::find(1);
    Laravel\be($customer)
        ->postJson(route('orders.store'))
        ->assertForbidden();
})->group('OrderStore');

test('admin can create an order in the admin', function () {
    $admin = User::find(3);
    $order = Order::factory()->make(['user_id' => 1, 'orderdate' => Carbon::now()->toDateTimeString()]);

    Laravel\be($admin)
        ->postJson(route('orders.store'), $order->toArray())
        ->assertRedirect(route('orders.index'));

    $this->assertDatabaseHas('orders',[
        'user_id' => 1,
        'orderdate' => $order->orderdate
    ]);
})->group('OrderStore');

test('sales can create an order in the admin', function () {
    $sales = User::find(2);
    $order = Order::factory()->make(['user_id' => 1, 'orderdate' => Carbon::now()->toDateTimeString()]);

    Laravel\be($sales)
        ->postJson(route('orders.store'), $order->toArray())
        ->assertRedirect(route('orders.index'));

    $this->assertDatabaseHas('orders',[
        'user_id' => 1,
        'orderdate' => $order->orderdate
    ]);
})->group('OrderStore');
