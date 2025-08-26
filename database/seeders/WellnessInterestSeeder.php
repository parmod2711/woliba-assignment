<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WellnessInterestSeeder extends Seeder
{
    public function run(): void
    {
        $interests = [
            'Yoga',
            'Meditation',
            'Fitness',
            'Nutrition',
            'Mindfulness',
            'Work-Life Balance',
        ];

        foreach ($interests as $interest) {
            DB::table('wellness_interests')->insert([
                'name' => $interest,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
