<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@admin.com',
            'password' => 'password123',
            'phone' => 123456,
            'address' => 'Location A',
            'type' => 'Admin',
            'status' => 'Active',
        ]);
    }
}
