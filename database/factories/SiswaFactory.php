<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class SiswaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Siswa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nik = $this->faker->nik();
        return [
            'user_id' => $this->faker->randomElement([1]),
            'kelas' => $this->faker->randomElement(['X-RPL001', 'XI-RPL001', 'XII-RPL001']),
            'nis' => $nik,
            'nama' => $this->faker->name(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['Pria', 'Wanita']),
            'alamat' => $this->faker->address(),
            'password' => Hash::make($nik),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
