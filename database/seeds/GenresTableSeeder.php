<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'name' => '小説'
        ]);
        DB::table('genres')->insert([
            'name' => '洋書'
        ]);
        DB::table('genres')->insert([
            'name' => 'プログラミング'
        ]);
        
    }
}
