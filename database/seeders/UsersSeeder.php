<?php

namespace Database\Seeders;

use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Todo: to customize.
        User::factory()->withMedia()->create([
            'first_name' => 'Admin',
            'last_name' => 'STARTER',
            'email' => 'admin@starter.test',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('secret'),
        ]);
        User::factory()->withMedia()->count(29)->create();
    }
}
