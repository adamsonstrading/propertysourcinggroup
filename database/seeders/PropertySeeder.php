<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    public function run()
    {
        // Clear existing properties for the demo
        Property::truncate();

        $properties = [
            [
                'location' => 'Scunthorpe, DN16',
                'description' => 'House, Semi-detached Freehold',
                'bmv_percentage' => '25',
                'type' => 'Buy Refurbish Rent Refinance',
                'yield' => '8.3%',
                'features' => "Freehold\nDriveway\nRear garden\nClose to local amenities and transport links\nCould achieve £700 – £750 pcm\nVacant upon completion",
                'image_url' => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=600'
            ],
            [
                'location' => 'Bakewell, DE45',
                'description' => 'House, Terrace Freehold',
                'bmv_percentage' => '22.1',
                'type' => 'AirBnB',
                'yield' => '15.2%',
                'features' => "Freehold\nGrade II listed\n£51,000 per annum gross rental\n£200 nightly average\n70% predicted occupancy\nRICS £420,000 in current condition",
                'image_url' => 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=600'
            ],
            [
                'location' => 'Tadley, RG26',
                'description' => 'Bungalow, Detached Freehold',
                'bmv_percentage' => '45',
                'type' => 'Refurb to Flip',
                'yield' => '20% Exit',
                'features' => "Freehold\nRefurb opportunity\nRICS value £300,000\nStrong demand from owner occupier\nGreat transport links\n50 Miles from London",
                'image_url' => 'https://images.unsplash.com/photo-1598228723793-52759bba239c?auto=format&fit=crop&w=600'
            ],
            [
                'location' => 'Manchester, M14 6QZ',
                'description' => 'Semi-detached Freehold',
                'bmv_percentage' => '31',
                'type' => 'Refurb to Flip',
                'yield' => '18.85% Exit',
                'features' => "Gross profit: £52,340\n3.3 Miles from Manchester City Centre\n3.7 Miles from Stockport\nFreehold",
                'image_url' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=600'
            ],
            [
                'location' => 'Scarborough, YO11',
                'description' => 'House, Terraced Freehold',
                'bmv_percentage' => '21.5',
                'type' => 'Buy To Let',
                'yield' => '8.5%',
                'features' => "Freehold\nSea views\nWalking distance to the seafront\nClose to the train station\nPotential for Airbnb\nScope for internal re-modelling",
                'image_url' => 'https://images.unsplash.com/photo-1480074568708-e7b720bb3f09?auto=format&fit=crop&w=600'
            ],
            [
                'location' => 'Bradford, BD12 7DE',
                'description' => 'House, Terraced Freehold',
                'bmv_percentage' => '24.3',
                'type' => 'Buy To Let',
                'yield' => '10.8%',
                'features' => "Freehold\n4.1 Miles to Bradford City Centre.\n1.5 Miles to M606 & M62.\nRecently renovated kitchen\nHigh rental demand area",
                'image_url' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=600'
            ]
        ];

        foreach ($properties as $property) {
            Property::create($property);
        }
    }
}
