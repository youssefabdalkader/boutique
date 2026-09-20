<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Governorate;
use App\Models\City;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $file = public_path('all.json');

        if (!file_exists($file)) {
            $this->command->error('all.json file not found.');

            return;
        }

        $data = json_decode(
            file_get_contents($file),
            true
        );

        if (!is_array($data)) {
            $this->command->error('Invalid JSON file.');

            return;
        }

        foreach ($data as $countryData) {

            /*
            |--------------------------------------------------------------------------
            | Country
            |--------------------------------------------------------------------------
            */

            $country = Country::updateOrCreate(
                [
                    'name' => $countryData['name'],
                ],

            );


            /*
            |--------------------------------------------------------------------------
            | States / Governorates
            |--------------------------------------------------------------------------
            */

            foreach ($countryData['states'] ?? [] as $stateData) {

                $governorate = Governorate::updateOrCreate(
                    [
                        'country_id' => $country->id,
                        'name' => $stateData['name'],
                    ],

                );


                /*
                |--------------------------------------------------------------------------
                | Cities
                |--------------------------------------------------------------------------
                */

                foreach ($stateData['cities'] ?? [] as $cityData) {

                    $cityName = is_array($cityData)
                        ? ($cityData['name'] ?? null)
                        : $cityData;

                    if (!$cityName) {
                        continue;
                    }

                    City::updateOrCreate(
                        [
                            'governorate_id' => $governorate->id,
                            'name' => $cityName,
                        ]
                    );
                }
            }
        }

        $this->command->info(
            'Countries, governorates and cities imported successfully.'
        );
    }
}