<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Nasabah;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $nasabah = Nasabah::where('user_id', Auth::user()->id)->count();
        $analisa = Alternative::where('user_id', Auth::user()->id)->count();
        $plans = Plan::all();
        $currentPlan = auth()->user()->subscription('default') ?? NULL;
        return view('dashboard', compact('nasabah', 'analisa', 'plans', 'currentPlan'));
    }
}
