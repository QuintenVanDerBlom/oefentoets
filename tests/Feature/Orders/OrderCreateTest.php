<?php

use App\Models\User;
use App\Models\Order;
use \Pest\Laravel;

beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->order = Order::factory()->create();
});

test('admin can see the order create page', function()
{
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('orders.create'))
        ->assertViewIs('admin.orders.create')
        ->assertSee(User::find(1)->name)
        ->assertSee(User::find(2)->name)
        ->assertSee(User::find(3)->name)
        ->assertStatus(200);
})->group('OrderCreate');

test('sales can see the order create page', function()
{
    $this->withoutExceptionHandling();
    $sales = User::find(2);
    Laravel\be($sales)
        ->get(route('orders.create'))
        ->assertViewIs('admin.orders.create')
        ->assertStatus(200);
})->group('OrderCreate');

test('customer can not see the order create page', function()
{
    $customer = User::find(1);
    Laravel\be($customer)
        ->get(route('orders.create'))
        ->assertForbidden();
})->group('OrderCreate');

test('guest can not see the order create page', function(){
    $this->get(route('orders.create'))
        ->assertRedirect(route('login'));
})->group('OrderCreate');

