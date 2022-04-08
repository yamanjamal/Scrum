<?php

namespace Database\Seeders;

use App\Models\Srs;
use Illuminate\Database\Seeder;

class SrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Srs::factory(10)->create();
    }
}
