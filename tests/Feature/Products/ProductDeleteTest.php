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
    $this->price = price::factory()->create();
});

test('guest can not see the product delete page', function(){
    $this->get(route('products.delete', ['product' => $this->product->id]))
        ->assertRedirect(route('login'));
})->group('ProductDelete');

test('customer can not see the product delete page', function()
{
    $customer = User::find(1);
    Laravel\be($customer)
        ->get(route('products.delete', ['product' => $this->product->id]))
        ->assertForbidden();
})->group('ProductDelete');

test('sales can not see the product delete page', function(){
    $sales = User::find(2);
    Laravel\be($sales)
        ->get(route('products.delete', ['product' => $this->product->id]))
        ->assertForbidden();
})->group('ProductDelete');

test('admin can see the product delete page', function(){
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('products.delete', ['product' => $this->product->id]))
        ->assertViewIs('admin.products.delete')
        ->assertSee($this->category->name)
        ->assertSee($this->product->name)
        ->assertSee($this->product->description)
        ->assertSee($this->product->latest_price->price)
        ->assertStatus(200);
})->group('ProductDelete');



