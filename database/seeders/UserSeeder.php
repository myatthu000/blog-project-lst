<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(6)->create();

        User::factory()->create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'role'=>'admin',
            'password'=> Hash::make('password'),
        ]);

        User::factory()->create([
            'name'=>'user1editor',
            'email'=>'editor@gmail.com',
            'role'=>'editor',
            'password'=> Hash::make('password'),
        ]);

        User::factory()->create([
            'name'=>'user2author',
            'email'=>'author@gmail.com',
            'role'=>'author',
            'password'=> Hash::make('password'),
        ]);

        User::factory()->create([
            'name'=>'user3',
            'email'=>'user3@gmail.com',
            'role'=>'author',
            'password'=> Hash::make('password'),
        ]);
    }
}
