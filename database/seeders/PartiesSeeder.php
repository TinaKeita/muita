<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PartiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents('https://deskplan.lv/muita/app.json');
        $data = json_decode($json, true); 
        $parties = $data['parties'] ?? [];    

        foreach ($parties as $p) {
            DB::table('parties')->insert([
                'id' => $p['id'] ?? null,
                'type' => $p['type'] ?? null,
                'name' => $p['name'] ?? null,
                'reg_code' => $p['reg_code'] ?? null,
                'vat' => $p['vat'] ?? null,
                'country' => $p['country'] ?? null,
                'email' => $p['email'] ?? null,
                'phone' => $p['phone'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
