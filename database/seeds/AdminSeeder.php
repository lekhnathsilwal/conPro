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
        $superAdmin = App\Models\User::create( [
            'name'=>'Super Admin',
            'email'=>'super@admin.com',
            'contact'=>'9843526424',
            'password'=> bcrypt('secret'),
            'type'=>0,
            'verified'=>1
        ]);
    }
}
