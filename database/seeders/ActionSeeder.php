<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Action::truncate();
        Schema::enableForeignKeyConstraints();

        $actions = ['store-blog', 'update-blog',  'delete-blog'];
        foreach($actions as $Key => $action){
            $new_action = new Action();
            $new_action->action = $action;
            $new_action->save();
        }
    }
}
