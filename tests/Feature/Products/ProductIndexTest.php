<?php

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Price;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->category = Category::factory()->create();
    $this->product = Product::factory()->create();
    $this->price = Price::factory()->create();
});

test('admin can see the product index page', function()
{
    $admin = User::find(3);
        Laravel\be($admin)
        ->get(route('products.index'))
        ->assertSee($this->product->name)
        ->assertSee($this->product->category->name)
        ->assertSee($this->product->latest_price->price)
        ->assertStatus(200);
})->group('ProductIndex');

test('sales can see the product index page', function()
{
    $sales = User::find(2);
    Laravel\be($sales)
        ->get(route('products.index'))
        ->assertSee($this->product->name)
        ->assertSee($this->product->category->name)
        ->assertSee($this->product->latest_price->price)
        ->assertStatus(200);
})->group('ProductIndex');

test('customer can not see the product index page', function()
{
    $customer = User::find(1);
    Laravel\be($customer)
        ->get(route('products.index'))
        ->assertForbidden();
})->group('ProductIndex');

test('guest can not see the product index page', function(){
   $this->get(route('products.index'))
        ->assertRedirect(route('login'));
})->group('ProductIndex');



