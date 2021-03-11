<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->words(rand(4,5),true);
        $slug = Str::slug($name);
        return [
            'name'=>$name,
            'slug'=>$slug,
            'short_description'=>$this->faker->text(150),
            'description'=>$this->faker->text(300),
            'regular_price'=>$this->faker->numberBetween(20,2000),
            'stock_status'=>'instock',
            'quantity'=>$this->faker->numberBetween(1,20),
            'image'=>'digital_'.$this->faker->unique()->numberBetween(1,22).'.jpg',
            'category_id'=>rand(1,5)

        ];
    }
}
