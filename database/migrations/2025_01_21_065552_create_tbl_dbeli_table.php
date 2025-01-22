<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_dbeli', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('no_transaksi');
            $table->foreign('no_transaksi')->references('id')->on('tbl_hbeli')->onDelete('cascade');
            $table->unsignedBigInteger('kode_barang');
            $table->foreign('kode_barang')->references('id')->on('tbl_barang')->onDelete('cascade');
            $table->integer('qty');
            $table->integer('diskon');
            $table->integer('total_rp');
            $table->integer('diskon_rp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_dbeli');
    }
};
