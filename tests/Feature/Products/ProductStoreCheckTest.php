<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use App\Models\Price;
use App\Models\User;

class ProductStoreCheckTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        // first include all the normal setUp operations
        parent::setUp();

        $this->seed('RoleAndPermissionSeeder');
        $this->seed('UserSeeder');
        $this->category = Category::factory()->create();
        $this->product = Product::factory()->create();
        $this->price = Price::factory()->create();
    }

    public function postProduct($overridesProduct = [], $overridesPrice = [])
    {
        $product = Product::factory()->make($overridesProduct);
        $price = Price::factory()->make($overridesPrice);
        return $this->postJson(route('products.store'), array_merge($product->toArray(),$price->toArray()));
    }

    /** @test
     *  @group ProductStoreCheck
     */
    function a_product_requires_a_name()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postProduct(['name' => NULL])->assertStatus(422);

    }

    /** @test
     *  @group ProductStoreCheck
     */
    function a_product_name_can_be_max_45_characters()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postProduct(['name' => '1234567890123456789012345678901234567890123456'])
            ->assertStatus(422);
    }

    /** @test
     *  @group ProductStoreCheck
     */
    function a_product_name_can_must_be_unique()
    {
        $admin = User::find(3);
        $product = Product::find(1);
        $this->actingAs($admin);
        $this->postProduct(['name' => $product->name])
            ->assertStatus(422);
    }

    /** @test
     *  @group ProductStoreCheck
     */
    function a_product_requires_a_description()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postProduct(['description' => null])
            ->assertStatus(422);
    }

    /** @test
     *  @group ProductStoreCheck
     */
    function a_product_requires_a_price()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postProduct([], ['price' => null])
            ->assertStatus(422);
    }

    /** @test
     *  @group ProductStoreCheck
     */
    function a_product_price_should_be_a_number()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postProduct([], ['price' => 'abc'])
            ->assertStatus(422);
    }

    /** @test
     *  @group ProductStoreCheck
     */
    function a_product_price_can_be_max_999999_99()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postProduct([], ['price' => 1000000.00])
            ->assertStatus(422);
    }



}
