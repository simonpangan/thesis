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
        DB::table('sexTable')->insert([
            [
                'Sex' => 'Male'
            ],
            [
                'Sex' => 'Female'
            ],
        ]);
        DB::table('subjects')->insert([
            [
                'subjectname' => 'Science'
            ],
            [
                'subjectname' => 'Math'
            ],      
            [
                'subjectname' => 'English'
            ],
        ]);


        DB::table('accounts')->insert([
            [
                'Name' => 'Simon Pangan',
                'SexId' => '1',
                'Role' => 'Admin',
                'Username' => 'simonpangan',
                'EmailAddress' => 'simonpangan@yahoo.com',
                'Password' => Hash::make('simonpangan'),

            ]
            , [

                'Name' => 'Simon Pangan12',
                'SexId' => '1',
                'Role' => 'User',
                'Username' => 'simonpangan12',
                'EmailAddress' => 'simonpangan12@yahoo.com',
                'Password' => Hash::make('simonpangan12'),

            ],

        ]);

        DB::table('phones')->insert([
            [
                'phone' => '09474411444',
                'accountid' => '1',
            ],
        ]);
        DB::table('users_subject')->insert([
            [
                'user_id' => '1',
                'subjectid' => '1'
            ],
            [
                'user_id' => '1',
                'subjectid' => '2'
            ],      
            [
                'user_id' => '2',
                'subjectid' => '1
                '
            ],
        ]);

        DB::table('posts')->insert([
            [
                'account_id' => '1',
                'post' => 'Post 1',
            ],

            [
                'account_id' => '1',
                'post' => 'Post 2',
            ],

            [
                'account_id' => '1',
                'post' => 'Post 3',
            ],

            [
                'account_id' => '1',
                'post' => 'Post 4',
            ],

            [
                'account_id' => '1',
                'post' => 'Post 5',
            ],

            [
                'account_id' => '1',
                'post' => 'Post 6',
            ],
            [
                'account_id' => '2',
                'post' => 'Post 4',
            ],

            [
                'account_id' => '2',
                'post' => 'Post 5',
            ],

            [
                'account_id' => '2',
                'post' => 'Post 6',
            ],
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
