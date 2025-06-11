<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $colorIds = Color::pluck('id')->toArray();


        $numberOfColorsToSelect = rand(1, min(4, count($colorIds)));

        // Select random color IDs and convert to array
        $colors = collect($colorIds)->random($numberOfColorsToSelect)->all();
        $colorString = implode(',', $colors);

        // Fetch category IDs from the database
        $categoryIds = Category::pluck('id')->toArray();
        $categoryId = collect($categoryIds)->random();


        // Fetch brand IDs from the database
        $brandIds = Brand::pluck('id')->toArray();
        $brandId = collect($brandIds)->random();

        // Get current date in d-m-y format
        $currentDate = Carbon::now()->format('d-m-y');

        return [
            "name" => $this->faker->text(20),
            "price" => $this->faker->numberBetween(200, 1500),
            "qty"   => $this->faker->numberBetween(5, 15),
            "desc" => $this->faker->paragraph(100),
            "category_id" => $categoryId,
            "brand_id" => $brandId,
            "color" => $colorString,
            "user_id" => 1,
            "created_at" => $currentDate,
            "updated_at" => $currentDate,
        ];
    }
}
