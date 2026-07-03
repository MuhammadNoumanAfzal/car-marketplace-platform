<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'nitroo@gmail.com');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('ADMIN_NAME', 'Nitro Motors Admin'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'Admin@12345')),
            ]
        );
    }
}
