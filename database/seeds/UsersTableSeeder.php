<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@localhost';
        $user->phone = '0x000000';
        $user->role = 1;
        $user->password = bcrypt('secret');
        $user->save();

    }
}
