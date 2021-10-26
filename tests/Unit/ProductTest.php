<?php

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Product;
use App\Models\Price;
use \Pest\Laravel;

beforeEach(function (){
    $this->category = Category::factory()->create();
    $this->product = Product::factory()->create();
    $this->price = Price::factory()->create();
});

test('a product has a price', function(){
    //$this->assertInstanceOf(Price::class, $this->product->latest_price); // PhpUnit Style
    expect($this->product->latest_price)->toBeInstanceOf(Price::class); // Pest expectations
})->group('ProductUnit');

test('a product is inside a category', function(){
    //$this->assertInstanceOf(Category::class, $this->product->category); // PhpUnit Style
    expect($this->product->category)->toBeInstanceOf(Category::class); // Pest expectations
})->group('ProductUnit');

test('a product name is a string', function(){
    //$this->assertIsString($this->product->name); // PhpUnit Style
    expect($this->product->name)->toBeString(); // Pest expectations
})->group('ProductUnit');

test('a product description is a string', function(){
    //$this->assertIsString($this->product->description); // PhpUnit Style
    expect($this->product->description)->toBeString(); // Pest expectations
})->group('ProductUnit');

test('a product id is an int', function(){
    //$this->assertIsInt($this->product->id); // PhpUnit Style
    expect($this->product->id)->toBeInt(); // Pest expectations
})->group('ProductUnit');

test('a product created at is a datetime', function(){
    //$this->assertInstanceOf(Carbon::class, $this->product->created_at); // PhpUnit Style
    expect($this->product->created_at)->toBeInstanceOf(Carbon::class); // Pest expectations
})->group('ProductUnit');

test('a product updated at is a datetime', function(){
    //$this->assertInstanceOf(Carbon::class, $this->product->updated_at); // PhpUnit Style
    expect($this->product->updated_at)->toBeInstanceOf(Carbon::class); // Pest expectations
})->group('ProductUnit');

