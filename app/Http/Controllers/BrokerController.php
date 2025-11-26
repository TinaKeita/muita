<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CustomsCase;

class BrokerController extends Controller
{
    public function index()
    {
        $cases = CustomsCase::with('documents')->orderBy('created_at', 'desc')->paginate(25);
        return view('broker', compact('cases'));
    }
}
