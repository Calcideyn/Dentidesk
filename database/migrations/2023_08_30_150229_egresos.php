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
        Schema::create('INGRESOS', function (Blueprint $table) {

            $table->id('id_ingreso');
            $table->dateTime('fecha_ingreso');
            $table->string('descripcion_ingreso');
            $table->integer('monto_ingreso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
