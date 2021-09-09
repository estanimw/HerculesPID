<?php

namespace Database\Factories;

use App\Models\Evento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Evento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => Str::random(5),
            'day' => Str::random(1),
            'start' => Str::random(1),
            'end' => Str::random(1),
            'color' => Str::random(5),
        ];
    }
}
