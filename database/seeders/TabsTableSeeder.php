<?php

namespace Database\Seeders;

use App\Models\Tab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TabsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tabsData = [
            [
                'name' => 'Tab 1',
                'capacity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tab 2',
                'capacity' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more data as needed
        ];

        Tab::insert($tabsData);
    }
}
