<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents('https://deskplan.lv/muita/app.json');
        $data = json_decode($json, true); 
        $vehicles = $data['vehicles'] ?? [];    

        foreach ($vehicles as $v) {
            DB::table('vehicles')->insert([
                'id' => $v['id'] ?? null,
                'plate_no' => $v['plate_no'] ?? null,
                'country' => $v['country'] ?? null,
                'make' => $v['make'] ?? null,
                'model' => $v['model'] ?? null,
                'vin' => $v['vin'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
