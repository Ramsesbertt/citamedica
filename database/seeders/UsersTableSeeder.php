<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ramses',
            'email' => 'ramsesbertt@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'cedula' => '0400000712',
            'address' => 'Av. Universitaria',
            'phone' => '096800009',
            'role' => 'admin',
        ]);

        User::factory()
            ->count(50)
            ->create();
    }
}
