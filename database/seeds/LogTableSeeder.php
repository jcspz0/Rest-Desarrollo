<?php

use Illuminate\Database\Seeder;

class LogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logs')->insert([
        	'log' => 'primer log',
        ]);
    }
}
