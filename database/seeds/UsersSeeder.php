<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ];

        $test = [
            'name' => 'teste',
            'email' => 'teste@teste.com',
            'password' => bcrypt('123456789')
        ];

        if(!User::where('email', 'admin@admin.com')->first()) {
            User::create($data);
        }

        if(!User::where('email', 'teste@teste.com')->first()) {
            User::create($test);
        }

    }
}
