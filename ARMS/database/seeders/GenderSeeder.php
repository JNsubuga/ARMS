<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [
            [
                'user_id' => 1,
                'Gender' => 'Female'
            ],
            [
                'user_id' => 1,
                'Gender' => 'Male'
            ]
        ];

        foreach ($genders as $gender) {
            Gender::create($gender);
        }
    }
}
