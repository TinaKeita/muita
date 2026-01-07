<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InspectorController extends Controller
{
    public function index()
    {
        $inspectorId = Auth::user()->username;

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

        // Flash a simple message
        return redirect('/inspector')
            ->with('status', "Case {$case->id} status changed to {$case->status}!");
    }
}
