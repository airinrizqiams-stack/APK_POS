<?php

namespace Database\Factories;

use App\Models\Jenis;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JenisFactory extends Factory
{
    protected $model = Jenis::class;

    public function definition(): array
    {
        return [
            'user_id'    => User::inRandomOrder()->value('id') ?? User::factory(),
            'nama_jenis' => $this->faker->unique()->word(),
        ];
    }
}