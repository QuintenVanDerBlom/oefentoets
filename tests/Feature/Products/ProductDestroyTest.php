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

test('customer can not destroy a product', function () {
    $customer = User::find(1);
    Laravel\be($customer);
    $this->json('DELETE',route('products.destroy', ['product' => $this->product->id]))
        ->assertForbidden();
})->group('ProductDestroy');

test('sales can not destroy a product', function () {
    $sales = User::find(2);
    Laravel\be($sales);
    $this->json('DELETE',route('products.destroy', ['product' => $this->product->id]))
        ->assertForbidden();
})->group('ProductDestroy');

test('guest can not destroy a product', function () {
    $this->json('DELETE',route('products.destroy', ['product' => $this->product->id]))
        ->assertStatus(401);
})->group('ProductDestroy');

test('admin can destroy a product', function(){
    $admin = User::find(3);
    Laravel\be($admin);
    $this->json('DELETE', route('products.destroy', ['product' => $this->product->id]));
    $this->assertDatabaseMissing('products', ['id' => $this->product->id]);
    $this->assertDatabaseMissing('prices', ['id' => $this->price->id]);
})->group('ProductDestroy');



