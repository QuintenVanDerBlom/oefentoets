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

test('guest can not see the order edit page', function(){
    $this->get(route('orders.edit', ['order' => $this->order->id]))
        ->assertRedirect(route('login'));
})->group('OrderEdit');

test('customer can not see the order edit page', function(){
    $customer = User::find(1);
    Laravel\be($customer)
        ->get(route('orders.edit', ['order' => $this->order->id]))
        ->assertForbidden();
})->group('OrderEdit');

test('sales can see the order edit page', function(){
    $sales = User::find(2);
    $this->withoutExceptionHandling();

    Laravel\be($sales)
        ->get(route('orders.edit', ['order' => $this->order->id]))
        ->assertViewIs('admin.orders.edit')
        ->assertSee($this->order->user->name)
        ->assertSee(Carbon::createFromFormat('Y-m-d H:i:s', $this->order->orderdate)
            ->format('Y-m-d\TH:i'))
        ->assertStatus(200);
})->group('OrderEdit');

test('admin can see the order edit page', function(){
    $admin = User::find(3);
    $this->withoutExceptionHandling();

    Laravel\be($admin)
        ->get(route('orders.edit', ['order' => $this->order->id]))
        ->assertViewIs('admin.orders.edit')
        ->assertSee($this->order->user->name)
        ->assertSee(Carbon::createFromFormat('Y-m-d H:i:s', $this->order->orderdate)
            ->format('Y-m-d\TH:i'))
        ->assertStatus(200);
})->group('OrderEdit');
