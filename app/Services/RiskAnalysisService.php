<?php
namespace App\Services;

use App\Models\CustomsCase;
use App\Models\Inspection;

class RiskAnalysisService
{
    public function calculate(CustomsCase $case)
    {
        $points = 0;

        if ($case->hs_code) {
            if (str_starts_with($case->hs_code, '93')) {
                $points += 5;
            } elseif (str_starts_with($case->hs_code, '27')) {
                $points += 3;
            }
        }

        /*
        | Maršruts
        */
        if (in_array($case->origin_country, ['RU', 'BY', 'UA'])) {
            $points += 3;
        }

        /*
        | Kravas vērtība (demo)
        */
        if ($case->cargo_value && $case->cargo_value > 100000) {
            $points += 2;
        }

        /*
        | Iepriekšēji pārkāpumi
        */
        if (!empty($case->risk_flags)) {
            $points += 4;
        }

        /*
        | Riska līmenis
        */
        if ($points >= 10) {
            $riskLevel = 'high';
        } elseif ($points >= 7) {
            $riskLevel = 'medium';
        } else {
            $riskLevel = 'low';
        }

        /*
        | Saglabā risku
        */
        $case->risk_score = $points;
        $case->risk_level = $riskLevel;
        $case->save();

        /*
        | Automatizēta inspection izveide
        */
        if ($riskLevel == 'high') {
            Inspection::create([
                'id' => Inspection::generateId(),
                'case_id' => $case->id,
                'type' => 'document',
                'requested_by' => 'system',
                'start_ts' => now()->toISOString(),
                'checks' => [
                    ['name' => 'Dokumentu pārbaude', 'result' => 'pending']
                ]
            ]);

            $case->status = 'screening';
            $case->save();
        }
    }
}
