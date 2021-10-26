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

test('guest can not update an order in the admin', function () {
    $this->patchJson(route('orders.update', ['order' => $this->order->id]))
        ->assertStatus(401);
})->group('OrderUpdate');

test('customer can not update an order in the admin', function () {
    $customer = User::find(1);
    Laravel\be($customer)
        ->patchJson(route('orders.update', ['order' => $this->order->id]))
        ->assertForbidden();
})->group('OrderUpdate');

test('admin can update an order in the admin', function () {
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin);
    $order = Order::factory()->make(['user_id' => 1, 'orderdate' => Carbon::now()->toDateTimeString()]);
    $newdate = Carbon::now()->addDays(10)->toDateTimeString();
    $this->patchJson(route('orders.update', ['order' => $this->order->id]),
        ['user_id' => 2, 'orderdate' => $newdate])->assertRedirect(route('orders.index'));

    $this->assertDatabaseHas('orders', ['user_id' => 2, 'orderdate' => $newdate]);
})->group('OrderUpdate');

test('sales can update an order in the admin', function () {
    $this->withoutExceptionHandling();
    $sales = User::find(2);
    Laravel\be($sales);
    $order = Order::factory()->make(['user_id' => 1, 'orderdate' => Carbon::now()->toDateTimeString()]);
    $newdate = Carbon::now()->addDays(10)->toDateTimeString();
    $this->patchJson(route('orders.update', ['order' => $this->order->id]),
        ['user_id' => 2, 'orderdate' => $newdate])->assertRedirect(route('orders.index'));

    $this->assertDatabaseHas('orders', ['user_id' => 2, 'orderdate' => $newdate]);
})->group('OrderUpdate');

