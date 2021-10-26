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

function patchProduct($overridesProduct = [], $overridesPrice = [])
{
    $product = Product::find(1)->make($overridesProduct);
    $price = Price::find(1)->make($overridesPrice);
    return Laravel\patchJson(route('products.update', ['product' => 1]),
        array_merge($product->toArray(),$price->toArray()));
}

test('a product requires a name', function(){
    $admin = User::find(3);
    Laravel\be($admin);
        patchProduct(['name' => null])
        ->assertStatus(422);
})->group('ProductUpdateCheck');

test('a product name can be max 45 characters', function(){
    $admin = User::find(3);
    Laravel\be($admin);
    patchProduct(['name' => '1234567890123456789012345678901234567890123456'])
        ->assertStatus(422);
})->group('ProductUpdateCheck');

test('a product name must be unique', function(){
    $admin = User::find(3);
    $product = Product::factory()->create(['name' => 'Product1']);
    Laravel\be($admin);
    patchProduct(['name' => 'Product1'])
        ->assertStatus(422);
})->group('ProductUpdateCheck');

test('a product requires a description', function(){
    $admin = User::find(3);
    Laravel\be($admin);
    patchProduct(['description' => null])
        ->assertStatus(422);
})->group('ProductUpdateCheck');

test('a product requires a price', function(){
    $admin = User::find(3);
    Laravel\be($admin);
    patchProduct([], ['price' => null])
        ->assertStatus(422);
})->group('ProductUpdateCheck');

test('a product price should be a number', function(){
    $admin = User::find(3);
    Laravel\be($admin);
    patchProduct([], ['price' => 'abc'])
        ->assertStatus(422);
})->group('ProductUpdateCheck');

test('a product price can be max 999999.99', function(){
    $admin = User::find(3);
    Laravel\be($admin);
    patchProduct([], ['price' => 1000000.00])
        ->assertStatus(422);
})->group('ProductUpdateCheck');

