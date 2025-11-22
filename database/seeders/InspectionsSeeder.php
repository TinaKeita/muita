<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class InspectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents('https://deskplan.lv/muita/app.json');
        $data = json_decode($json, true);
        $inspections = $data['inspections'] ?? [];

        foreach ($inspections as $i) {
            DB::table('inspections')->insert([
                'id' => $i['id'],
                'case_id' => $i['case_id'] ?? null,
                'type' => $i['type'] ?? null,
                'requested_by' => $i['requested_by'] ?? null,
                'start_ts' => $i['start_ts'] ?? null,
                'location' => $i['location'] ?? null,
                'checks' => json_encode($i['checks'] ?? []), 
                'assigned_to' => $i['assigned_to'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
