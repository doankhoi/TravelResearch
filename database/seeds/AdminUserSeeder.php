<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	'username' => 'matatabi',
        	'password' => bcrypt('matatabi12345'),
        	'email' => 'matatabi@gmail.com'
        ];

        User::create($data);
    }
}
