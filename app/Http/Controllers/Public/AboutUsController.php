<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ZoneDignitary;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $boardMembers = ZoneDignitary::all();

        return view('public.about-us', compact('boardMembers'));
    }
}
