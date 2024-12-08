<?php

namespace Database\Factories;

use App\Models\Makalah;
use Illuminate\Database\Eloquent\Factories\Factory;

class MakalahFactory extends Factory
{
    protected $model = Makalah::class;

    public function definition()
    {
        return [
            'Judul_Artikel' => $this->faker->sentence(),
            'Penulis' => $this->faker->name(),
            'Nama_Seminar' => $this->faker->word(),
            'Penyelenggara_Seminar' => $this->faker->company(),
            'Waktu_Pelaksaaan' => $this->faker->date(),
            'URL' => $this->faker->url(),
        ];
    }
}
