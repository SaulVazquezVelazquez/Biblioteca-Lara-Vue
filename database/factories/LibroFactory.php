<?php

namespace Database\Factories;

use App\Models\Libro;
use Illuminate\Database\Eloquent\Factories\Factory;

class LibroFactory extends Factory
{

    protected $model = Libro::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombreLi' => $this->faker->name(),
            'autorLi' => $this->faker->streetName(),
            'statusLi' => $this->faker->randomElement(['Disponible','Disponible']),
            'user_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
// 'nombreLi',
// 'autorLi',
// 'descripcion',