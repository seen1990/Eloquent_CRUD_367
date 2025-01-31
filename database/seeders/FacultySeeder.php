<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faculties = [
            'Architecture',
            'Economics',
            'Engineering',
            'Science',
            'Medicine',
            'Nursing',
            'Pharmacy',
            'Law',
        ];

        foreach ($faculties as $faculty) {
            DB::table('faculties')->insert([
                'faculty_name' => $faculty,
            ]);
        }
    }
}
