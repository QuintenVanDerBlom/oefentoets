<?php

use App\Models\User;
use App\Models\Order;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->order = Order::factory()->create();
});

test('guest can not destroy an order', function () {
    $this->json('DELETE',route('orders.destroy', ['order' => $this->order->id]))
        ->assertStatus(401);
})->group('OrderDestroy');

test('customer can not destroy an order', function () {
    $customer = User::find(1);
    Laravel\be($customer);
    $this->json('DELETE',route('orders.destroy', ['order' => $this->order->id]))
        ->assertForbidden();
})->group('OrderDestroy');

test('sales can not destroy an order', function () {
    $sales = User::find(2);
    Laravel\be($sales);
    $this->json('DELETE',route('orders.destroy', ['order' => $this->order->id]))
        ->assertForbidden();
})->group('OrderDestroy');

test('admin can destroy an order', function(){
    $admin = User::find(3);
    Laravel\be($admin);
    $this->json('DELETE', route('orders.destroy', ['order' => $this->order->id]))
        ->assertRedirect(route('orders.index'));
    $this->assertDatabaseMissing('orders', ['id' => $this->order->id]);
})->group('OrderDestroy');



