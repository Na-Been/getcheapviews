<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();
        User::updateOrCreate([
           'name'=>'super user',
           'email'=>'admin@admin.com',
           'password'=>bcrypt('12345678'),
            'status'=>1
        ]);
    }
}
