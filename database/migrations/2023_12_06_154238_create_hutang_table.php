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
        Schema::create('tbl_hutang', function (Blueprint $table) {
            $table->id();
            $table->string('notransaksi', 10);
            $table->string('kodespl', 10);
            $table->dateTime('tglbeli');
            $table->integer('totalhutang');
            $table->timestamps();

            $table->foreign('notransaksi')->references('notransaksi')->on('tbl_hbeli')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('tbl_hutang');
    }
};
