<?php

namespace App\Http\Controllers;

use App\Console\Commands\CoinDataStart;
use App\CriptoData;
use App\CriptoMap;
use Illuminate\Http\Request;
use Artisan;

class CriptoController extends Controller
{
    public function index()
    {
        $list = CriptoMap::all();

        return view('coins.index', ['list' => $list]);
    }

    public function coninMarketApiData()
    {
        Artisan::call('coindata:start');
        $list = CriptoMap::all();

        return view('coins.cripto_table', ['list' => $list]);
    }
}
