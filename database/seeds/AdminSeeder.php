<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_admin')->insert([
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin'),
        ]);
    }
}
