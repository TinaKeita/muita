<?php
namespace App\Services;

use App\Models\CustomsCase;
use App\Models\Inspection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;  

class RiskAnalysisService
{
    public function calculate(CustomsCase $case)
    {
        $points = 1;

        /* Maršruts */
        if (in_array($case->origin_country, ['RU', 'BY', 'UA'])) {
            $points += 3;
        }

        /* Iepriekšēji pārkāpumi */
        if (!empty($case->risk_flags)) {
            foreach ($case->risk_flags as $flag) {
                $points += 1; 
            }
        }

        /* Riska līmenis */
        if ($points >= 5) {
            $riskLevel = 'high';
        } elseif ($points >= 3) {
            $riskLevel = 'medium';
        } else {
            $riskLevel = 'low';
        }

        /* Saglabā risku */
        $case->risk_score = $points;
        $case->risk_level = $riskLevel;
        $case->save();

        /* Automatizēta inspection izveide */
        if ($riskLevel === 'high') {
            $this->createAutoInspection($case);

        }
    }

   private function createAutoInspection(CustomsCase $case)
        {
            $inspectionId = 'insp-' . str_pad(Inspection::count() + 1, 6, '0', STR_PAD_LEFT);
            
            // Random type
            $types = ['document', 'xray', 'physical'];
            $type = $types[rand(0, 2)];
            
            // Random inspector
            $inspectors = DB::table('users')->where('role', 'inspector')->pluck('username')->toArray();
            $inspector = $inspectors[rand(0, count($inspectors)-1)] ?? 'unassigned';
            
            $checks = [
                ['name' => 'Pārbaude 1', 'result' => 'pending'],
                ['name' => 'Pārbaude 2', 'result' => 'pending']
            ];
            
            Inspection::create([
                'id' => $inspectionId,
                'case_id' => $case->id,
                'type' => $type,
                'requested_by' => 'risk-engine',
                'start_ts' => now(),
                'location' => 'RIX-CP-01',
                'checks' => $checks,
                'assigned_to' => $inspector,
            ]);
        }

}
