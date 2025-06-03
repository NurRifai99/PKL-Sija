<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class GuruSeed extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            // Buat user dengan nama dan email pendek
            $name = $faker->firstName();
            $email = strtolower(substr($name, 0, 3)) . $faker->unique()->numberBetween(1, 99) . '@mail.com';
            
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password123'), // password default aman
            ]);

            // Buat data guru terkait user_id
            Guru::create([
                'user_id' => $user->id,
                'nama' => $name,
                'nip' => $faker->unique()->numerify('GURU####'),
                'gender' => $faker->randomElement(['L', 'P']),
                'alamat' => $faker->address(),
                'kontak' => $faker->phoneNumber(),
            ]);
            
            $user->assignRole('guru'); 
        }
    }
}
