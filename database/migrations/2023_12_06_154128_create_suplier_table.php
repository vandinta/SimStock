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
        Schema::create('tbl_suplier', function (Blueprint $table) {
            $table->id();
            $table->string('kodespl', 10);
            $table->string('namaspl', 100);
            $table->timestamps();

            $table->index('kodespl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_suplier');
    }
};
