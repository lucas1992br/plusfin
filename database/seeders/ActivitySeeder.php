<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Activity::factory(10)->create();
    }
}
