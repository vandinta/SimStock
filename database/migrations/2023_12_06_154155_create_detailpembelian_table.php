<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dbeli', function (Blueprint $table) {
            $table->id();
            $table->string('notransaksi', 10);
            $table->string('kodebrg', 10);
            $table->integer('hargabeli');
            $table->integer('qty');
            $table->integer('diskon')->nullable();
            $table->integer('diskonrp')->nullable();
            $table->integer('totalrp');
            $table->timestamps();

            $table->foreign('notransaksi')->references('notransaksi')->on('tbl_hbeli')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('kodebrg')->references('kodebrg')->on('tbl_barang')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_dbeli');
    }
};
