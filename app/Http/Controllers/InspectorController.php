<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Illuminate\Http\Request;

class InspectorController extends Controller
{
    public function index()
    {
        $inspectorId = 'user363'; // TODO: replace when auth exists

        $inspections = Inspection::where('assigned_to', $inspectorId)
            ->whereHas('case', function ($query) {
                $query->whereNotIn('status', ['released', 'closed']);
            })
            ->with('case')
            ->get();

        return view('inspector.index', compact('inspections'));
    }

    public function decision(Request $request, $id)
    {
        $inspection = Inspection::findOrFail($id);
        $case = $inspection->case;

        $decisions = [
            'released' => 'released',
            'hold' => 'on_hold',
            'reject' => 'closed',
        ];

        $case->status = $decisions[$request->decision];
        $case->save();

        return redirect('/inspector')->with('success', 'Decision saved!');
    }
}
