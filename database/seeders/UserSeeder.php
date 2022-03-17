<?php

namespace Database\Seeders;

use App\Models\User;
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
        
        User::create([
            'name'  => 'Desarrollador',
            'email'  => 'desarrollador@mail.com',
            'password'  => bcrypt('12345678'),
        ])->assignRole('desarrollador');

        User::create([
            'name'  => 'Administrativos',
            'email'  => 'administrativos@mail.com',
            'password'  => bcrypt('12345678'),
        ])->assignRole('administrativos');
        
        User::create([
            'name'  => 'Prestatarios',
            'email'  => 'prestatarios@mail.com',
            'password'  => bcrypt('12345678'),
        ])->assignRole('prestatarios');
    }
}
