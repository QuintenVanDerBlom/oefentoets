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

test('guest can not create an product in the admin', function () {
    $this->postJson(route('products.store'))
        ->assertStatus(401);
})->group('ProductStore');

test('customer can not create an product in the admin', function () {
    $customer = User::find(1);
    Laravel\be($customer)
        ->postJson(route('products.store'))
        ->assertForbidden();
})->group('ProductStore');

test('admin can create a product in the admin', function () {
    $admin = User::find(3);
    $product = Product::factory()->make();
    $price = Price::factory()->make();

    Laravel\be($admin)
        ->postJson(route('products.store'), array_merge($product->toArray(),$price->toArray()))
        ->assertRedirect(route('products.index'));

    $this->assertDatabaseHas('products',[
       'name' => $product->name,
       'description' => $product->description
    ]);
    $this->assertDatabaseHas('prices',[
        'price' => $price->price
    ]);
})->group('ProductStore');

test('sales can create a product in the admin', function () {
    $sales = User::find(2);
    $product = Product::factory()->make();
    $price = Price::factory()->make();

    Laravel\be($sales)
        ->postJson(route('products.store'), array_merge($product->toArray(),$price->toArray()))
        ->assertRedirect(route('products.index'));

    $this->assertDatabaseHas('products',[
        'name' => $product->name,
        'description' => $product->description
    ]);
    $this->assertDatabaseHas('prices',[
        'price' => $price->price
    ]);
})->group('ProductStore');
