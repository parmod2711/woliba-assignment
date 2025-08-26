<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WellbeingPillarSeeder extends Seeder
{
    public function run(): void
    {
        $pillars = [
            'Physical',
            'Mental',
            'Social',
            'Financial',
            'Emotional',
        ];

        foreach ($pillars as $pillar) {
            DB::table('wellbeing_pillars')->insert([
                'name' => $pillar,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
