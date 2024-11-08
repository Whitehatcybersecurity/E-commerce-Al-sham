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
        $data = [
            [
                'name'     => 'Super Admin',
                'role_id' => '1',
                'email'         => 'admin@gmail.com',
                'password'      => Hash::make('123456789'),
            ]
        ];

        User::insert($data);
    }
}
