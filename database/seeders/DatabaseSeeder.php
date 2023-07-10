<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => Hash::make('1234'),
        ]);
        Service::factory(6)->create();
        Message::factory(10)->create();
    }
}
