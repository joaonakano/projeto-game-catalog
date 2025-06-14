<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Game::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->sentence(3); // Gera um nome único
        return [
            'uuid' => Str::uuid(), // Gera um UUID
            'name' => $name,
            'description' => $this->faker->paragraph,
            'release_date' => $this->faker->date('Y-m-d'), // Formato de data
            'developer' => $this->faker->company,
            'publisher' => $this->faker->company,
            'game_picture' => 'game_pictures/default.jpg', // Defina um valor padrão ou gere um caminho aleatório
        ];
    }
}
