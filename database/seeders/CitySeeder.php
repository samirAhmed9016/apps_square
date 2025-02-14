<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Cairo' => ['Nasr City', 'Heliopolis', 'Maadi', 'New Cairo'],
            'Giza' => ['Dokki', 'Mohandessin', '6th of October City'],
            'Alexandria' => ['Sporting', 'Stanley', 'Smouha', 'Montaza'],
            'Dakahlia' => ['Mansoura', 'Talkha', 'Mit Ghamr'],
            'Red Sea' => ['Hurghada', 'Safaga', 'Marsa Alam'],
            'Beheira' => ['Damanhur', 'Kafr El Dawar', 'Edku'],
            'Fayoum' => ['Fayoum City', 'Ibshaway', 'Sinnuris'],
            'Gharbia' => ['Tanta', 'El Mahalla El Kubra', 'Kafr El Zayat'],
            'Ismailia' => ['Ismailia City', 'Fayed', 'El Qantara'],
            'Menoufia' => ['Shibin El Kom', 'Ashmoun', 'Menouf'],
            'Minya' => ['Minya City', 'Maghagha', 'Samalut'],
            'Qalyubia' => ['Banha', 'Qalyub', 'Shubra El Kheima'],
            'New Valley' => ['Kharga', 'Dakhla', 'Farafra'],
            'Suez' => ['Suez City', 'Ataka', 'Arbaeen'],
            'Aswan' => ['Aswan City', 'Kom Ombo', 'Edfu'],
            'Asyut' => ['Asyut City', 'Abnub', 'Dayrout'],
            'Beni Suef' => ['Beni Suef City', 'Biba', 'Al Wasta'],
            'Port Said' => ['Port Said City', 'Port Fouad'],
            'Damietta' => ['Damietta City', 'Ras El Bar', 'Ezbet El Borg'],
            'Sharkia' => ['Zagazig', 'Bilbeis', 'Abu Hammad'],
            'South Sinai' => ['Sharm El Sheikh', 'Dahab', 'Taba'],
            'Kafr El Sheikh' => ['Kafr El Sheikh City', 'Baltim', 'Desouk'],
            'Matrouh' => ['Marsa Matruh', 'Siwa', 'El Alamein'],
            'Luxor' => ['Luxor City', 'Armant', 'Esna'],
            'Qena' => ['Qena City', 'Deshna', 'Nag Hammadi'],
            'North Sinai' => ['Arish', 'Sheikh Zuweid', 'Rafah'],
            'Sohag' => ['Sohag City', 'Akhmim', 'Girga'],
        ];

        foreach ($cities as $stateName => $cityList) {
            $state = State::where('name', $stateName)->first();
            if ($state) {
                foreach ($cityList as $city) {
                    City::create([
                        'name' => $city,
                        'state_id' => $state->id
                    ]);
                }
            }
        }
    }
}
