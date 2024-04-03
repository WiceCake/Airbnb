<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\Barangay;
use App\Models\Discount;
use App\Models\Province;
use Illuminate\Support\Arr;
use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Json;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $amenities = [
            [
                "name" => "Cable & TV",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Wifi",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Kitchen",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Refrigerator",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Coffee Maker",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Dishes and silverware",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Cooking Stive",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Beach Access",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Private Patio or Balcony",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Free Parking",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Washing Machine",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Dryer",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Air-conditioning",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Smoke Alarm",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Backyard",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Bathtub",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "BBQ Grill",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "CCTV",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Swimming Pool",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Exercise Equipment",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ];

        $types = [
            [
                "name" => "House",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Apartment",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Bed and Breakfast",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Cabin",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Villa",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Condo Unit",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Camper/RV",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Farmhouse",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Guesthouse",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ];

        $policies = [
            [
                "name" => "flexible",
                "description" => "full refund up to one-day prior arrival",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "moderate",
                "description" => "full refund 5 days prior arrival, 70% refund 3 days prior arrival, 50% refund 1-day prior arrival",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "strict",
                "description" => "70% refund 5 days prior arrival, 50% refund 3 days prior arrival, 30% refund 1-day prior arrival",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ];

        $refunds = [
            [
                "policy_id" => 1,
                "days" => 0,
                "refund_percentage" => 1.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "policy_id" => 2,
                "days" => 5,
                "refund_percentage" => 1.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "policy_id" => 2,
                "days" => 3,
                "refund_percentage" => 0.7,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "policy_id" => 2,
                "days" => 1,
                "refund_percentage" => 0.5,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "policy_id" => 3,
                "days" => 5,
                "refund_percentage" => 0.7,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "policy_id" => 3,
                "days" => 3,
                "refund_percentage" => 0.5,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "policy_id" => 3,
                "days" => 1,
                "refund_percentage" => 0.3,
                "created_at" => now(),
                "updated_at" => now()
            ],
        ];

        $discounts = [
            [
                "name" => "New Listing",
                "nights" => 0,
                "percentage" => 0.20,
                "description" => "discount",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Weekly discount",
                "nights" => 7,
                "percentage" => 0.10,
                "description" => "(7 nights or more) discount",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Monthly discount",
                "nights" => 28,
                "percentage" => 0.25,
                "description" => "(28 nights or more) discount",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ];

        $managers = [
            [
                'username' => 'owner1',
                'password' => bcrypt('0wner1@PNSC'),
                'fullname' => 'Daniel Albertz',
            ],
            [
                'username' => 'owner2',
                'password' => bcrypt('0wner2@PNSC'),
                'fullname' => 'Seklet Admirez',
            ],
        ];

        \App\Models\Manager::insert($managers);
        \App\Models\Amenity::insert($amenities);
        \App\Models\Type::insert($types);
        \App\Models\Discount::insert($discounts);
        \App\Models\CancellationPolicy::insert($policies);
        \App\Models\CancellationRefund::insert($refunds);
    }
}
