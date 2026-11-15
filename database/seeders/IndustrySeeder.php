<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('industries')->insert(array_map(
            fn ($name) => ['name' => $name],
            ['Software', 'Plumbing', 'Electrical', 'Mechanical', 'Gardening',
                'Design', 'Moving', 'Transport', 'Roofing', 'Carpentry',
                'Marketing', 'Business', 'Retail', 'Construction', 'Hospitality']
        ));
    }
}
