<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        $user               = new User();
        $user->first_name   = 'Ibrahim';
        $user->last_name    = 'AOULAD ABDERAHMAN';
        $user->email        = 'i@gmail.com';
        $user->id_role      = 1;
        $user->password     = Hash::make('Admin123');
        $user->save();

        $user               = new User();
        $user->first_name   = 'User F';
        $user->last_name    = 'User L';
        $user->email        = 'u@gmail.com';
        $user->id_role      = 2;
        $user->password     = Hash::make('User123');
        $user->save();
    }
}
