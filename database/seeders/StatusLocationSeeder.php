<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $countries = Country::whereIn('name', [
            'Egypt',
            'Saudi Arabia',
        ])->get();
        foreach ($countries as $country) {

            // تفعيل الدولة
            $country->update([
                'status' => true,
            ]);
            $country->governorates()->update([
                'status' => true,
            ]);
            $country->governorates()
                ->with('cities')
                ->get()
                ->each(function ($governorate) {

                    $governorate->cities()->update([
                        'status' => true,
                    ]);
                });
        }
        $this->command->info(
            'Egypt and Saudi Arabia with their governorates and cities have been enabled successfully.'
        );
    }
}
