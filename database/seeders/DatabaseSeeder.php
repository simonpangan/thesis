<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('accounts')->insert([
            [
                'Name' => 'Simon Pangan',
                'Role' => 'Admin',
                'Username' => 'simonpangan',
                'EmailAddress' => 'simonpangan@yahoo.com',
                'Password' => Hash::make('simonpangan'),

            ]
            , [

                'Name' => 'Simon Pangan12',
                'Role' => 'User',
                'Username' => 'simonpangan12',
                'EmailAddress' => 'simonpangan12@yahoo.com',
                'Password' => Hash::make('simonpangan12'),

            ]
            
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
