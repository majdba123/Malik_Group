<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@malikgroup.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
            ]
        )->forceFill(['is_admin' => true])->save();
    }
}
