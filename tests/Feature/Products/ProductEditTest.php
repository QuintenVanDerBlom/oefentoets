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

test('customer can not see the product edit page', function()
{
    $customer = User::find(1);
    Laravel\be($customer)
        ->get(route('products.edit', ['product' => $this->product->id]))
        ->assertForbidden();
})->group('ProductEdit');

test('guest can not see the product edit page', function(){
    $this->get(route('products.edit', ['product' => $this->product->id]))
        ->assertRedirect(route('login'));
})->group('ProductEdit');

test('admin can see the product edit page', function(){
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('products.edit', ['product' => $this->product->id]))
        ->assertViewIs('admin.products.edit')
        ->assertSee($this->category->name)
        ->assertSee($this->product->name)
        ->assertSee($this->product->description)
        ->assertSee($this->product->latest_price->price)
        ->assertStatus(200);
})->group('ProductEdit');

test('sales can see the product edit page', function(){
    $sales = User::find(2);
    Laravel\be($sales)
        ->get(route('products.edit', ['product' => $this->product->id]))
        ->assertViewIs('admin.products.edit')
        ->assertSee($this->category->name)
        ->assertSee($this->product->name)
        ->assertSee($this->product->description)
        ->assertSee($this->product->latest_price->price)
        ->assertStatus(200);
})->group('ProductEdit');

