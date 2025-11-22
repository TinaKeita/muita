<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $json = file_get_contents('https://deskplan.lv/muita/app.json');
        $data = json_decode($json, true); 
        $users = $data['users'] ?? [];    

        foreach ($users as $u) {
            DB::table('users')->insert([
                'id' => $u['id'] ?? null,
                'username' => $u['username'] ?? null,
                'full_name' => $u['full_name'] ?? null,
                'role' => $u['role'] ?? null,
                'active' => $u['active'] ?? true,
                'password' => Hash::make('password'), //default "password"
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
