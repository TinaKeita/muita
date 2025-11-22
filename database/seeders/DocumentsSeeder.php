<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents('https://deskplan.lv/muita/app.json');
        $data = json_decode($json, true);
        $documents = $data['documents'] ?? [];

        foreach ($documents as $d) {
            DB::table('documents')->insert([
                'id' => $d['id'],
                'case_id' => $d['case_id'] ?? null,
                'filename' => $d['filename'] ?? null,
                'mime_type' => $d['mime_type'] ?? null,
                'category' => $d['category'] ?? null,
                'pages' => $d['pages'] ?? null,
                'uploaded_by' => $d['uploaded_by'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
