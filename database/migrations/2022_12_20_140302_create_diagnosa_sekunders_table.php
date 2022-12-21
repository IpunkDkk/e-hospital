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
        Schema::create('diagnosa_sekunders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("rekam-medik-id");
            $table->string("diagnosa");
            $table->string("keterangan")->nullable();

            $table->foreign("rekam-medik-id")->on("rekam_mediks")->references("id")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnosa_sekunders');
    }
};
