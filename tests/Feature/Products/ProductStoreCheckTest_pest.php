<?php
/*
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


function postProduct($overrides = [])
{
    $product = Product::factory()->make($overrides);
    $price = Price::factory()->make();
    return Laravel\postJson(route('products.store'), array_merge($product->toArray(),$price->toArray()));
}

test('a product requires a name', function(){
    $admin = User::find(3);

    Laravel\be($admin);
        postProduct(['name' => null])
        ->assertStatus(422);
})->group('ProductStoreCheck');

test('a product requires a name2', function(){
    $admin = User::find(3);
    $product = Product::factory()->make(['name' => null]);
    $price = Price::factory()->make();

    Laravel\be($admin)
        ->postJson(route('products.store'), array_merge($product->toArray(),$price->toArray()))
        ->assertStatus(422);

    $this->assertDatabaseMissing('products',[
        'name' => $product->name,
        'description' => $product->description
    ]);
    $this->assertDatabaseMissing('prices',[
        'price' => $price->price
    ]);
})->group('ProductStoreCheck');
*/
