<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Address;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommerceFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_access_account(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test Customer',
            'phone' => '123456789',
            'email' => 'customer@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/my-account');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'customer@example.com']);
        $this->get('/my-account')->assertOk();
    }

    public function test_anonymous_user_can_add_and_update_cart(): void
    {
        $category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'is_active' => true,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Test Product',
            'slug' => 'test-product',
            'price' => 25,
            'stock_quantity' => 10,
            'is_active' => true,
        ]);

        $this->post('/cart', [
            'product_id' => $product->id,
            'quantity' => 2,
        ])->assertSessionHasNoErrors();

        $this->get('/cart')->assertOk();
        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }

    public function test_home_product_actions_are_bound_to_the_displayed_product(): void
    {
        $category = Category::create([
            'name' => 'Home Category',
            'slug' => 'home-category',
            'is_active' => true,
        ]);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Featured Product',
            'slug' => 'featured-product',
            'description' => 'Product description',
            'price' => 19.95,
            'stock_quantity' => 4,
            'is_active' => true,
        ]);
        $relatedProduct = Product::create([
            'category_id' => $category->id,
            'name' => 'Related Product',
            'slug' => 'related-product',
            'description' => 'Related description',
            'price' => 29.95,
            'stock_quantity' => 2,
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Featured Product')
            ->assertSee('data-product-id="'.$product->id.'"', false)
            ->assertSee('name="product_id" value="'.$product->id.'"', false)
            ->assertSee('id="quick-view"', false);

        $this->get(route('shop'))
            ->assertOk()
            ->assertSee('data-product-id="'.$product->id.'"', false)
            ->assertSee('id="quick-view"', false);

        $this->get(route('product.details', $product->slug))
            ->assertOk()
            ->assertSee('data-product-id="'.$relatedProduct->id.'"', false)
            ->assertSee('id="quick-view"', false);
    }

    public function test_wishlist_action_saves_the_selected_product_only_once(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Wishlist Category',
            'slug' => 'wishlist-category',
            'is_active' => true,
        ]);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Favorite Product',
            'slug' => 'favorite-product',
            'price' => 15,
            'stock_quantity' => 3,
            'is_active' => true,
        ]);

        $this->actingAs($user)->post(route('wishlist.store'), [
            'product_id' => $product->id,
        ])->assertSessionHasNoErrors();
        $this->post(route('wishlist.store'), [
            'product_id' => $product->id,
        ])->assertSessionHasNoErrors();

        $this->assertDatabaseCount('wishlists', 1);
        $this->assertDatabaseHas('wishlists', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }

    public function test_user_can_manage_only_their_own_addresses(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $addressData = [
            'label' => 'Home',
            'recipient_name' => 'Test Customer',
            'phone' => '123456789',
            'address_line_1' => '12 Test Street',
            'city' => 'Test City',
            'postal_code' => '16000',
            'country' => 'Algeria',
        ];

        $this->actingAs($user)
            ->post(route('addresses.store'), $addressData)
            ->assertSessionHasNoErrors();

        $address = Address::where('user_id', $user->id)->firstOrFail();
        $this->assertTrue($address->is_default);
        $this->get(route('my-account'))->assertOk()->assertSee('12 Test Street');

        $this->put(route('addresses.update', $address), array_merge($addressData, [
            'label' => 'Office',
            'address_line_1' => '99 New Street',
        ]))->assertSessionHasNoErrors();
        $this->assertDatabaseHas('addresses', [
            'id' => $address->id,
            'label' => 'Office',
            'address_line_1' => '99 New Street',
        ]);

        $this->actingAs($otherUser)
            ->delete(route('addresses.destroy', $address))
            ->assertNotFound();

        $this->actingAs($user)
            ->delete(route('addresses.destroy', $address))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('addresses', ['id' => $address->id]);
    }

    public function test_authenticated_checkout_creates_order_and_updates_stock(): void
    {
        $user = User::factory()->create(['role' => 'customer']);
        $category = Category::create([
            'name' => 'Checkout Category',
            'slug' => 'checkout-category',
            'is_active' => true,
        ]);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Checkout Product',
            'slug' => 'checkout-product',
            'price' => 30,
            'stock_quantity' => 5,
            'is_active' => true,
        ]);

        $this->actingAs($user);
        $this->post('/cart', [
            'product_id' => $product->id,
            'quantity' => 2,
        ])->assertSessionHasNoErrors();

        $this->post('/checkout', [
            'name' => 'Test Customer',
            'phone' => '123456789',
            'email' => $user->email,
            'address' => '12 Test Street',
            'city' => 'Test City',
            'state' => 'Test State',
            'country' => 'Algeria',
            'zip' => '16000',
        ])->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'customer_email' => $user->email,
        ]);
        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock_quantity' => 3,
        ]);
    }

    public function test_admin_role_can_open_dashboard(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk();
    }

    public function test_action_buttons_submit_supported_forms(): void
    {
        $this->post('/contact-us', [
            'first_name' => 'Test',
            'email' => 'test@example.com',
            'comment' => 'Test message',
        ])->assertSessionHas('status');

        $this->post('/newsletter', [
            'email' => 'newsletter@example.com',
        ])->assertSessionHas('status');

        $this->post('/blog/comment', [
            'name' => 'Test',
            'email' => 'test@example.com',
            'comment' => 'Test comment',
        ])->assertSessionHas('status');

        $this->post('/coupon', [
            'coupon' => 'INVALID',
        ])->assertSessionHasErrors('coupon');
    }
}
