<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\JiliUsers;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $jiliusersdata = [

            [
                "user_id"=>"1",
                "img"=>"random1.jpg",
                "name"=>"Andrew C. Brown",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"2",
                "img"=>"random2.jpg",
                "name"=>"James C. Bell",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"3",
                "img"=>"random3.jpg",
                "name"=>"Christopher B. Thomas",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"4",
                "img"=>"random4.jpg",
                "name"=>"Alfred E. Humble",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"5",
                "img"=>"random1.jpg",
                "name"=>"John R. Hopson",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"5",
                "img"=>"random2.jpg",
                "name"=>"Antonio H. Nugent",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"7",
                "img"=>"random3.jpg",
                "name"=>"David S. Shaw",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"8",
                "img"=>"random4.jpg",
                "name"=>"Bennie I. Williams",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"9",
                "img"=>"random4.jpg",
                "name"=>"James N. McAllister",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"10",
                "img"=>"random1.jpg",
                "name"=>"John K. Johnson",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"11",
                "img"=>"random2.jpg",
                "name"=>"Marcus B. Gilbert",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"12",
                "img"=>"random3.jpg",
                "name"=>"Joseph C. Tate",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"13",
                "img"=>"random4.jpg",
                "name"=>"Wayne R. Landreth",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"14",
                "img"=>"random1.jpg",
                "name"=>"Carl T. Beringer",
                "amount"=>"1000000",
            ],
            [
                "user_id"=>"15",
                "img"=>"random2.jpg",
                "name"=>"Richard K. Neal",
                "amount"=>"1000000",
            ]
        ];

        JiliUsers::insert($jiliusersdata);

    }
}
