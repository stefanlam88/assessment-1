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
       $user = new User;
       $user->name = 'John Doe';
       $user->email = 'john1@gmail.com';
       $user->password = bcrypt('123456');
       $user->address = 'address 123';
       $user->zipcode = '43500';
       $user->state = 'Selangor';
       $user->city = 'Semenyih';
       $user->save();
    }
}
