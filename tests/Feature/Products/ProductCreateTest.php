<?php

use App\Models\User;
use App\Models\Category;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->category = Category::factory()->create();
});

test('customer can not see the product create page', function()
{
    $customer = User::find(1);
    Laravel\be($customer)
        ->get(route('products.create'))
        ->assertForbidden();
})->group('ProductCreate');

test('guest can not see the product create page', function(){
    $this->get(route('products.create'))
        ->assertRedirect(route('login'));
})->group('ProductCreate');


test('admin can see the product create page', function(){
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('products.create'))
        ->assertViewIs('admin.products.create')
        ->assertStatus(200);;
})->group('ProductCreate');

test('sales can see the product create page', function(){
    $sales = User::find(2);
    Laravel\be($sales)
        ->get(route('products.create'))
        ->assertViewIs('admin.products.create')
        ->assertStatus(200);;
})->group('ProductCreate');

