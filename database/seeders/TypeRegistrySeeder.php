<?php

namespace Database\Seeders;

use App\Models\TypeRegistry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeRegistrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeRegistry::firstOrCreate(['id' => 1, 'name' => 'Food']);
        TypeRegistry::firstOrCreate(['id' => 2, 'name' => 'Notes']);
    }
}
