<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'the_silence001',
            'password' => bcrypt('Scorpion001'),
            'role' => 1
        ]);
        DB::table('users')->insert([
            'username' => 'dangphuchuu',
            'password' => bcrypt('1'),
            'role' => 1
        ]);
        DB::table('logos')->insert([
            'image'=>'logo1.jpg',
        ]);
        DB::table('banners')->insert([
            'image'=>'banner1.jpg'
        ]);
        
        DB::table('footers')->insert([
            'image'=>'footer1.jpg'
        ]);
        
    }
}
