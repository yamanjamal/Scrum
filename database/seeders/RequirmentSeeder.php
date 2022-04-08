<?php

namespace Database\Seeders;

use App\Models\Requirment;
use Illuminate\Database\Seeder;

class RequirmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Requirment::factory(10)->create();
    }
}
