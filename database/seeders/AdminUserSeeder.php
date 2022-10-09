<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Partner;
use App\Models\User;



class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->truncate();

        $user = new User();

        $user->name = "System Administrator";
        $user->email = "admin@admin.com";
        $user->password = bcrypt("4dm1n@2022");

        $user->save();
    }
}
