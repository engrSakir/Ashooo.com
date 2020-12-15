<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'name' => 'Ashooo',
            'sms_key' => 'ab5821e83a99eb9ec4774c962cb768a0',
        ]);
    }
}
