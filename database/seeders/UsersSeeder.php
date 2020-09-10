<?php

namespace Database\Seeders;

use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    use HasFactory;

    public function run(): void
    {
        (new User)->factory()->make([
            'first_name' => 'Admin',
            'last_name' => 'STARTER',
            'email' => 'admin@starter.test',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('secret'),
        ]);
        (new User)->factory()->count(29)->make();
    }
}
