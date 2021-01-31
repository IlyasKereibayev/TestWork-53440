<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \App\Faker\Provider\Book($this->faker));
        return [
            'title' => $this->faker->bookTitle(5),
            'isbn'  => $this->faker->ISBN(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(8, 78) * 100
        ];
    }
}
