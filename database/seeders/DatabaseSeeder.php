<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Service::factory(6)->create();
        Message::factory(10)->create();
    }
}
