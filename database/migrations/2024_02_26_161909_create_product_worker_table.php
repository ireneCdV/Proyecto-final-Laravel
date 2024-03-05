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
        Schema::create('product_worker', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('units'); //unidades
            $table->unsignedBigInteger('product_id'); //Clave foranea de la tabla productos
            $table->unsignedBigInteger('worker_id');  //Clave foranea de la tabla trabajdor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_worker');
    }
};
