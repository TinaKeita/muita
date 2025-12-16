<?php

namespace App\Http\Controllers;
use App\Models\CustomsCase;
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

        return back();
    }
}
