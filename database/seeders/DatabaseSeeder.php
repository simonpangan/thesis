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
                'Username' => 'simonpangan',
                'EmailAddress' => 'simonpangan@yahoo.com',
                'Password' => Hash::make('simonpangan'),

            ]
            , [

                'Name' => 'Simon Pangan12',
                'Username' => 'simonpangan12',
                'EmailAddress' => 'simonpangan12@yahoo.com',
                'Password' => Hash::make('simonpangan12'),

            ]
            , [

                'Name' => 'Simon Pangan123',
                'Username' => 'simonpangan123',
                'EmailAddress' => 'simonpangan123@yahoo.com',
                'Password' => Hash::make('simonpangan123'),

            ]
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
