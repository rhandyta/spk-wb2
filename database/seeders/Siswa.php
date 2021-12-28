<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Siswa extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Siswa::factory(650)->create();
    }
}
