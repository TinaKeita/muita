<?php

namespace App\Http\Controllers;
use App\Models\Inspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InspectorController extends Controller
{
    public function index(Request $request)
    {
        $inspectorId = Auth::user()->username;

        $query = Inspection::where('assigned_to', $inspectorId)
            ->whereHas('case', function ($query) {
                $query->whereNotIn('status', ['released', 'closed']);
            })
            ->with('case');


        // filtret pec satus
        if ($request->type) {
            $query->where('type', $request->type);
        }

        // filtret pec prioritatem
        if ($request->priority) {
            $query->whereHas('case', function ($q) use ($request) {
                $q->where('priority', $request->priority);
            });
        }


        $inspections = $query->paginate(25);
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

        // message prieks redirect
        return redirect('/inspector')
            ->with('status', "Case {$case->id} status changed to {$case->status}!");
    }
}
