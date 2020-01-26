<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::query()->create([
            'name' => 'Admin User',
            'email' => 'admin@junkdeal.com',
            'password' => bcrypt('secret')
        ]);
    }
}
