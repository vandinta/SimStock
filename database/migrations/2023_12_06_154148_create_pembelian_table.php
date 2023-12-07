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
        Schema::create('tbl_hbeli', function (Blueprint $table) {
            $table->id();
            $table->string('notransaksi', 10);
            $table->string('kodespl', 10);
            $table->dateTime('tgl_beli');
            $table->timestamps();

            $table->index('notransaksi');

            $table->foreign('kodespl')->references('kodespl')->on('tbl_suplier')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_hbeli');
    }
};
