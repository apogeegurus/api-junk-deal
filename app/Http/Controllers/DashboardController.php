<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $quotes = Quote::query()->orderBy('created_at', 'DESC')->paginate(20);
        return view('quotes', compact('quotes'));
    }
}
