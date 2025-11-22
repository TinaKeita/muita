<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents('https://deskplan.lv/muita/app.json');
        $data = json_decode($json, true);
        $cases = $data['cases'] ?? [];
        
        foreach ($cases as $c) {
            DB::table('cases')->insert([
                'id' => $c['id'],
                'external_ref' => $c['external_ref'] ?? null,
                'status' => $c['status'] ?? null,
                'priority' => $c['priority'] ?? null,
                'arrival_ts' => $c['arrival_ts'] ?? null,
                'checkpoint_id' => $c['checkpoint_id'] ?? null,
                'origin_country' => $c['origin_country'] ?? null,
                'destination_country' => $c['destination_country'] ?? null,

                // risk_flags array → JSON string for database storage
                'risk_flags' => json_encode($c['risk_flags'] ?? []),

                'declarant_id' => $c['declarant_id'] ?? null,
                'consignee_id' => $c['consignee_id'] ?? null,
                'vehicle_id' => $c['vehicle_id'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
