<?php

namespace App\Http\Controllers;

use App\CriptoData;
use App\CriptoMap;
use Illuminate\Http\Request;

class CriptoController extends Controller
{
    public function index()
    {
        $list = CriptoMap::orderBy('percent_change_24h', 'desc')->get();

        return view('coins.index', ['list' => $list]);
    }
}
