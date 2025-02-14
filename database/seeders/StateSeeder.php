<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            'Cairo',
            'Giza',
            'Alexandria',
            'Dakahlia',
            'Red Sea',
            'Beheira',
            'Fayoum',
            'Gharbia',
            'Ismailia',
            'Menoufia',
            'Minya',
            'Qalyubia',
            'New Valley',
            'Suez',
            'Aswan',
            'Asyut',
            'Beni Suef',
            'Port Said',
            'Damietta',
            'Sharkia',
            'South Sinai',
            'Kafr El Sheikh',
            'Matrouh',
            'Luxor',
            'Qena',
            'North Sinai',
            'Sohag'
        ];

        foreach ($states as $state) {
            State::create(['name' => $state]);
        }
    }
}
