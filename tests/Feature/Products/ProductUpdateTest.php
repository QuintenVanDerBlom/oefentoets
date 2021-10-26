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

test('customer can not update a product', function () {
    $customer = User::find(1);
    $product = Product::find(1);
    $price = Price::find(1);
    Laravel\be($customer)
        ->patchJson(route('products.update', ['product' => $this->product->id]),
            array_merge($product->toArray(),$price->toArray()))
        ->assertForbidden();
})->group('ProductUpdate');

test('guest can not update a product', function () {
    $product = Product::find(1);
    $price = Price::find(1);
    $this->patchJson(route('products.update', ['product' => $this->product->id]),
            array_merge($product->toArray(),$price->toArray()))
        ->assertStatus(401);
})->group('ProductUpdate');

test('admin can update a product', function () {
    $admin = User::find(3);
    $newcategory = Category::factory()->create(['name' => 'TestCategorie']);
    Laravel\be($admin)
        ->patchJson(route('products.update', ['product' => $this->product->id]),
        ['name' => 'Een productnaam',
            'description' => 'Blablabla',
            'price' => 1.00,
            'category_id' => $newcategory->id]
    );

    $this->product = $this->product->fresh();

    $this->get(route('products.index'))
        ->assertSee('Een productnaam')
        ->assertSee(1.00)
        ->assertSee($newcategory->name);

    $this->get(route('products.index'))
        ->assertSee($this->product->name)
        ->assertSee($this->product->category->name)
        ->assertSee($this->product->latest_price->price);
})->group('ProductUpdate');

test('sales can update a product', function () {
    $sales = User::find(2);
    $newcategory = Category::factory()->create(['name' => 'Nog een categorie']);
    Laravel\be($sales)
        ->patchJson(route('products.update', ['product' => $this->product->id]),
            ['name' => 'Nog een product',
                'description' => 'Lorem ipsum',
                'price' => 2.00,
                'category_id' => $newcategory->id]
        );

    $this->product = $this->product->fresh();

    $this->get(route('products.index'))
        ->assertSee('Nog een product')
        ->assertSee(2.00)
        ->assertSee($newcategory->name);

    $this->get(route('products.index'))
        ->assertSee($this->product->name)
        ->assertSee($this->product->category->name)
        ->assertSee($this->product->latest_price->price);
})->group('ProductUpdate');
