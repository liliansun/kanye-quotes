<?php

namespace Database\Seeders;

use App\Models\ApiAccess;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        ApiAccess::create([
            'domain_name' => 'localhost:8085',
            'token' => Hash::make('QvpquzXzAZqynhYUrdJlv3G1GtxI7hFdiXCuyTbAk18ImCYf4ZkZXIzyEjz9PyWD'),
        ]);
    }
}
