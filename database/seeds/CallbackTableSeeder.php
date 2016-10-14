<?php

use Illuminate\Database\Seeder;

class CallbackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('callbacks')->insert([
        	'task' => 'Tarefa XXX',
        	'activity_history' => '8988776655445393',
        ]);
    }
}
