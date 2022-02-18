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
        User::updateOrCreate(
          [
            'email'   =>  'kawalsohi14@gmail.com  ',
          ],
          [
              'username'    =>  'kawalsohi',
              'users_empcode' =>  '0004',
              'users_fname'   =>  'Kawal',
              'users_lname'   =>  'Sohi',
              'name'  =>  'kawal Sohi',
              'password'    => '123456',
              'users_password_hint'   =>  '123456',
              'users_contact' =>  '9501732031',
          ]
      );
    }
}
