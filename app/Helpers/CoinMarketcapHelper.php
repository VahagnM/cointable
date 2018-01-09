<?php
namespace App\Helpers;

/**
 * Created by PhpStorm.
 * User: Jean
 * Date: 1/9/2018
 * Time: 5:24 PM
 */
class CoinMarketcapHelper
{

    public static function getCoinmarketData($limit = 100)
    {
        $ch = curl_init('https://api.coinmarketcap.com/v1/ticker/?limit=' . $limit);
        curl_setopt($ch, CURLOPT_NOBODY, 0); // remove body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        $error = null;
        if (curl_errno($ch)) {
            $error = curl_error($ch);
        }
        curl_close($ch);

        return json_decode($response, true);
    }

}