<?php

namespace Database\Seeders;

use App\Helpers\Helper;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        $new_Role = new Role();
        $new_Role->role = Helper::ADMIN_ROLE;
        $new_Role->save();

        $new_Role = new Role();
        $new_Role->role = Helper::USER_ROLE;
        $new_Role->save();

    }
}
