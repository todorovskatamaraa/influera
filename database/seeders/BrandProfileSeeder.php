<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BrandProfile;
use App\Models\User;

class BrandProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $fitlife = User::where('email', 'fitlife@example.com')->first();
        $ecoWear = User::where('email', 'ecowear@example.com')->first();
        $chefMate = User::where('email', 'chefmate@example.com')->first();

        BrandProfile::create([
            'user_id'           => $fitlife->id,
            'company_name'      => 'FitLife Gear',
            'industry'          => 'Fitness',
            'about'             => 'Home workout equipment for small spaces.',
            'website'           => 'https://fitlife.test',
            'location'          => 'Berlin, Germany',
            'company_logo_path' => 'images/picture1.png',
            'company_cover_path' => 'images/picture1.png',
        ]);

        BrandProfile::create([
            'user_id'           => $ecoWear->id,
            'company_name'      => 'EcoWear',
            'industry'          => 'Fashion',
            'about'             => 'Sustainable clothing brand.',
            'website'           => 'https://ecowear.test',
            'location'          => 'Amsterdam, Netherlands',
            'company_logo_path' => 'images/picture2.png',
            'company_cover_path' => 'images/picture2.png',
        ]);

        BrandProfile::create([
            'user_id'           => $chefMate->id,
            'company_name'      => 'ChefMate',
            'industry'          => 'Food & Beverage',
            'about'             => 'Smart cooking app & tools.',
            'website'           => 'https://chefmate.test',
            'location'          => 'London, UK',
            'company_logo_path' => 'images/picture3.png',
            'company_cover_path' => 'images/picture3.png',
        ]);
    }
}
