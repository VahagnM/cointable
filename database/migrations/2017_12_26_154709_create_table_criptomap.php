<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCriptomap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criptomap', function(Blueprint $table){
            $table->increments('cript_id');
            $table->string('id');
            $table->string('name');
            $table->string('symbol');
            $table->integer('rank')->nullable();
            $table->double('price_usd', 15, 8)->nullable();
            $table->double('price_btc', 15, 12)->nullable();
            $table->double('24h_volume_usd', 15, 1)->nullable();
            $table->double('market_cap_usd', 15, 1)->nullable();
            $table->double('available_supply', 15, 1)->nullable();
            $table->double('total_supply', 15, 1)->nullable();
            $table->double('max_supply', 15, 1)->nullable();
            $table->decimal('percent_change_1h', 10, 2)->nullable();
            $table->decimal('percent_change_24h', 10, 2)->nullable();
            $table->decimal('percent_change_7d', 10, 2)->nullable();
            $table->integer('last_updated', false, true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('criptomap', function(Blueprint $table){
            $table->dropIfExists();
        });
    }
}
