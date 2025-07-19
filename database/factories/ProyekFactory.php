<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proyek;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyek>
 */
class ProyekFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'user_id' => User::factory(),
            'nameProyek' => $this->faker->word(),
            'lokasi' => $this->faker->city(),
            'jenis' => $this->faker->word(),
            'nilai' => $this->faker->numberBetween(1000000, 100000000),
            'gambar' => $this->faker->imageUrl(640, 480, 'business', true),
            'file_path' => $this->faker->filePath(),
            'deskripsi' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['active', 'non-active']),
        ];
    }
}
