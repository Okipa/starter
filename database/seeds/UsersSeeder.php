<?php

use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        factory(User::class)->create([
            'first_name' => 'Admin',
            'last_name' => 'STARTER',
            'email' => 'admin@starter.test',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('secret'),
        ]);
        for ($ii = 0; $ii <= 28; $ii++) {
            factory(User::class)->create();
        }
    }
}
