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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk'); // Nama produk
            $table->bigInteger('harga'); // Harga Produk
            $table->integer('stok'); // Stok Produk
            $table->unsignedBigInteger('kategori_id'); // Foreign Key ke table Kategori
            $table->timestamps();

            // Definisi relasi Foreign Key
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
