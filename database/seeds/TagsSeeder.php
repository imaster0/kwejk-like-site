<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tags')->insert(['name' => 'politics']);
        DB::table('tags')->insert(['name' => 'culture']);
        DB::table('tags')->insert(['name' => 'technics']);
        DB::table('tags')->insert(['name' => 'everyday_life']);
    }
}
