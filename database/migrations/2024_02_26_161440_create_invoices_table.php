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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('num_invoice')->nullable(false); // Esto crea 'num_invoice' que sera el numero de factura de cada usuario
            $table->dateTime('date')->nullable(); //Fecha del pedido
            $table->decimal('total', 10, 2); //total de la factura
            $table->unsignedBigInteger('user_id'); //crear la clave foranea
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
