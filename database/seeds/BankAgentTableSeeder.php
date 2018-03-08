<?php

use Illuminate\Database\Seeder;

class BankAgentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('bankagent')->insert([
         'name' => 'Emila Xhura',
         'email' => 'emila.xhura@raiffeisen.al',
         'phone' => '+355662065473',
     ]);
      DB::table('bankagent')->insert([
         'name' => 'Alban Petku',
         'email' => 'alban.petku@raiffeisen.al',
         'phone' => '++355697044246',
     ]);
      DB::table('bankagent')->insert([
         'name' => 'Eris Peti',
         'email' => 'eris.peti@raiffeisen.al',
         'phone' => '+355696032171',
     ]);
    }
}
