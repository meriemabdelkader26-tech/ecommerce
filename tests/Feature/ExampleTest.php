<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_storefront_pages_are_available(): void
    {
        $routes = [
            '/',
            '/shop',
            '/search?q=chair',
            '/product/demo',
            '/cart',
            '/blog',
            '/blog/details',
            '/login',
            '/register',
            '/about-us',
            '/contact-us',
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertOk();
        }
    }

    public function test_private_pages_require_authentication(): void
    {
        $this->get('/checkout')->assertRedirect('/login');
        $this->get('/my-account')->assertRedirect('/login');
        $this->get('/order-tracking')->assertRedirect('/login');
        $this->get('/wishlist')->assertRedirect('/login');
        $this->get('/wishlist/list')->assertRedirect('/login');
        $this->get('/thankyou')->assertRedirect('/login');
        $this->get('/orders')->assertRedirect('/login');
    }

    public function test_admin_pages_require_admin_role(): void
    {
        $this->get('/admin')->assertRedirect('/login');

        $customer = User::factory()->make([
            'id' => 2,
            'role' => 'customer',
        ]);

        $this->actingAs($customer)
            ->get('/admin')
            ->assertForbidden();
    }

    public function test_authenticated_user_can_open_profile(): void
    {
        $user = User::factory()->make([
            'id' => 1,
            'email' => 'profile-test@example.com',
        ]);

        $this->actingAs($user)
            ->get('/my-account')
            ->assertOk();
    }

    public function test_template_assets_are_available(): void
    {
        $assets = [
            'assets/css/vendors/bootstrap.css',
            'assets/css/demo4.css',
            'assets/css/custom.css',
            'assets/js/jquery-3.5.1.min.js',
            'assets/js/script.js',
            'assets/images/logo.png',
            'assets/images/furniture-images/poster/1.png',
        ];

        foreach ($assets as $asset) {
            $this->assertFileExists(public_path($asset));
        }
    }
}
