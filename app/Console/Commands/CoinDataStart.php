<?php

namespace App\Console\Commands;

use App\CriptoData;
use App\CriptoMap;
use Illuminate\Console\Command;

class CoinDataStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coindata:start {--limit=100 : limit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ch = curl_init('https://api.coinmarketcap.com/v1/ticker/?limit=' . $this->option('limit'));
        curl_setopt($ch, CURLOPT_NOBODY, 0); // remove body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        $error = null;
        if (curl_errno($ch)) {
            $error = curl_error($ch);
        }
        curl_close($ch);

        $data = json_decode($response, true);
        $ids = [];
        foreach ($data as $coin) {
            \DB::table('criptodates')->insert($coin);
            $map = CriptoMap::where('id', $coin['id'])->first();
            if(empty($map)) {
                $map = new CriptoMap();
            }
            $map->id = $coin['id'];
            $map->name = $coin['name'];
            $map->symbol = $coin['symbol'];
            $map->rank = $coin['rank'];
            $map->price_usd = $coin['price_usd'];
            $map->price_btc = $coin['price_btc'];
            $map->{'24h_volume_usd'} = $coin['24h_volume_usd'];
            $map->market_cap_usd = $coin['market_cap_usd'];
            $map->available_supply = $coin['available_supply'];
            $map->total_supply = $coin['total_supply'];
            $map->max_supply = $coin['max_supply'];
            $map->percent_change_1h = $coin['percent_change_1h'];
            $map->percent_change_24h = $coin['percent_change_24h'];
            $map->percent_change_7d = $coin['percent_change_7d'];
            $map->last_updated = $coin['last_updated'];
            $map->save();
        }

    }
}
