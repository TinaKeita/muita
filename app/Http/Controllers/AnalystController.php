<?php

namespace App\Http\Controllers;
use App\Models\CustomsCase;
use App\Models\Inspection;
use Illuminate\Http\Request;
use App\Services\RiskAnalysisService;


class AnalystController extends Controller
{
    public function index()
    {
        
        $cases = CustomsCase::paginate(25);
        return view('analyst.cases', compact('cases'));
    }


    public function runRisk($id, RiskAnalysisService $service)
    {
        $case = CustomsCase::findOrFail($id);
        $service->calculate($case);
        
        $inspections = Inspection::where('case_id', $case->id)->count();
        $riskLevel = $case->risk_level;
        
        return back();
    }

}
