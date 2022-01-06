<?php

namespace App\Http\Controllers;

use App\Models\komponen;
use App\Models\subKomponen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KomponenController extends Controller
{
    public function index()
    {
        $komponen = komponen::get();
        $jmlData = count($komponen);




        // $data = subKomponen::query('SELECT * FROM sub_komponens')->groupBy('komponens_id')->get();
        return view('frontend.home', compact('komponen', 'jmlData'));
    }
}
