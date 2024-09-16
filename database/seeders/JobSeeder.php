<?php

namespace Database\Seeders;

use App\Models\Jobs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jobs::factory(100)->create();
    }
}
