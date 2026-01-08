<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CustomsCase;
use App\Models\Document;

class BrokerController extends Controller
{
    public function index(Request $request)
    {
        $query = CustomsCase::with('documents')->orderBy('created_at', 'desc');
                
        // Search
        if ($request->search) {
            $query->where('id', 'like', '%' . $request->search . '%');
        }

        // filtret pec satus
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // filtret pec prioritatem
        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        $cases = $query->paginate(25);
        
        return view('broker', compact('cases'));
    }



    public function storeDocument(Request $request)
    {
        $request->validate([
            'case_id' => 'required',
            'filename' => 'required',
            'category' => 'required',
            'pages' => 'required|integer',
        ]);

        Document::create([
            'id' => Document::generateId(),
            'case_id' => $request->case_id,
            'filename' => $request->filename,
            'mime_type' => 'application/pdf',
            'category' => $request->category,
            'pages' => $request->pages,
            'uploaded_by' => auth()->user()->username,   
        ]);

        return back()->with('success', 'Document uploaded!');
    }

    public function showDocument($id)
    {
        $document = \App\Models\Document::findOrFail($id);

        return view('broker_document', compact('document')); 
    }




}
