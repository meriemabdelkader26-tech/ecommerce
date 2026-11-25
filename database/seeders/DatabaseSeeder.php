<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => 'password', 'role' => 'customer']
        );

        $categories = [
            ['name' => 'Furniture', 'slug' => 'furniture', 'description' => 'Furniture and home decor'],
            ['name' => 'Fashion', 'slug' => 'fashion', 'description' => 'Modern clothing and accessories'],
            ['name' => 'Shoes', 'slug' => 'shoes', 'description' => 'Comfortable and stylish shoes'],
            ['name' => 'Accessories', 'slug' => 'accessories', 'description' => 'Fashion accessories'],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                array_merge($categoryData, ['is_active' => true])
            );

            for ($index = 1; $index <= 3; $index++) {
                $name = "{$category->name} Product {$index}";
                $slug = "{$category->slug}-product-{$index}";
                $product = Product::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'category_id' => $category->id,
                        'name' => $name,
                        'description' => "Description of {$name}.",
                        'price' => 25 + ($index * 10),
                        'compare_at_price' => 45 + ($index * 10),
                        'stock_quantity' => 20 + ($index * 5),
                        'is_active' => true,
                    ]
                );

                $imageNumber = (($category->id - 1) * 3 + $index);
                $imageNumber = (($imageNumber - 1) % 36) + 1;
                ProductImage::updateOrCreate(
                    ['product_id' => $product->id, 'is_primary' => true],
                    [
                        'path' => "assets/images/fashion/product/front/{$imageNumber}.jpg",
                        'position' => 0,
                    ]
                );
            }
        }
    }
}
