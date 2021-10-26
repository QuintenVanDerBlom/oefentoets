<?php

use App\Models\User;
use App\Models\Order;
use \Pest\Laravel;

beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->order = Order::factory()->create();
});

test('admin can see the order index page', function()
{
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('orders.index'))
        ->assertViewIs('admin.orders.index')
        ->assertSee($this->order->id)
        ->assertSee($this->order->orderdate)
        ->assertSee($this->order->user->name)
        ->assertStatus(200);
})->group('OrderIndex');

test('sales can see the order index page', function()
{
    $this->withoutExceptionHandling();
    $sales = User::find(2);
    Laravel\be($sales)
        ->get(route('orders.index'))
        ->assertViewIs('admin.orders.index')
        ->assertSee($this->order->id)
        ->assertSee($this->order->orderdate)
        ->assertSee($this->order->user->name)
        ->assertStatus(200);
})->group('OrderIndex');


test('customer can not see the order index page', function()
{
    $customer = User::find(1);
    Laravel\be($customer)
        ->get(route('orders.index'))
        ->assertForbidden();
})->group('OrderIndex');

test('guest can not see the order index page', function(){
    $this->get(route('orders.index'))
        ->assertRedirect(route('login'));
})->group('OrderIndex');

