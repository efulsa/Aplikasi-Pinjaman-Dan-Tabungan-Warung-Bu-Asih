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
        $admin = new \App\User;
        $admin->isAdmin = 1;
        $admin->name = "Admin";
        $admin->email = "admin@wba.com";
        $admin->password = \Hash::make("anwar01junisaeful");
        $admin->save();
    }
}
