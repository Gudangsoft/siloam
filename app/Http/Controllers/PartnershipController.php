<?php

namespace App\Http\Controllers;

use App\Models\Partnership;

class PartnershipController extends Controller
{
    public function index()
    {
        $national      = Partnership::active()->where('type', 'nasional')->get();
        $international = Partnership::active()->where('type', 'internasional')->get();
        return view('frontend.partnerships.index', compact('national', 'international'));
    }
}
