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
        Schema::create('rekam_mediks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("no-medik")->unique(); //nomor rekam medik
            $table->enum("masuk", ["inap", "konsultasi"]);
            $table->enum("status", ["Masuk", "Keluar"])->default("Masuk");
            $table->date("tgl-keluar")->nullable(); //tanggal keluar
            $table->string("d-utama"); //diagnosa utama
            $table->text("tindakan")->nullable(); //tindakan atau operasi
            $table->string("k-krs"); //keadaan keluar rumah sakit
            $table->string("c-krs")->nullable(); //cara keluar rumah sakit
            $table->string("c-mrs")->nullable(); //cara masuk rumah sakit
            $table->string("d-merawat"); // dokter yang merawat

            $table->foreign("user_id")->on("users")->references("id")->onUpdate("cascade");
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
        Schema::dropIfExists('rekam_mediks');
    }
};
