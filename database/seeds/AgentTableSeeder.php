<?php

use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agent::updateOrCreate(
            [
              'email'   =>  'pawan.newweb29@gmail.com',
            ],
            [
                'name'    =>  'Pawan',
                'company_name' =>  'netweb',
                'company_email'   =>  'pawan.newweb29@gmail.com',
                'company_contact'   =>  '9876543210',
                'user_ref_id'  =>  '1',
                'address' => 'Amritsar', 'country_id' => '91', 'city_id' => '20768',
                'password'    => '123456',
                'password_hint'   =>  '123456',
                'created_user_id' =>  '1',
            ]
        );
    }
}
