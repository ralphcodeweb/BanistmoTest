<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();

        User::create([
            'name' => 'Rafael Martinez',
            'email' => 'rafa@localhost.com',
            'password' => bcrypt('secret')
        ]);
    }
}
