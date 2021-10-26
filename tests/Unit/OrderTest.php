<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use \Pest\Laravel;

beforeEach(function (){
    $this->user = User::factory()->create();
    $this->order = Order::factory()->create();
});

test('a order orderdate is a datetime', function () {
    expect($this->order->orderdate)->toBeInstanceOf(Carbon::class);
})->group('OrderUnit');

test('An order belongs to a user', function(){
    expect($this->order->user)->toBeInstanceOf(User::class);
})->group('ProductUnit');

test('a order user id is an int', function () {
    expect($this->order->user_id)->toBeInt();
})->group('OrderUnit');

test('a order id is an int', function () {
    expect($this->order->id)->toBeInt();
})->group('OrderUnit');

test('a order created at is a datetime', function () {
    expect($this->order->created_at)->toBeInstanceOf(Carbon::class);
})->group('OrderUnit');

test('a order updated at is a datetime', function () {
    expect($this->order->updated_at)->toBeInstanceOf(Carbon::class);
})->group('OrderUnit');
