<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('EGRESOS', function (Blueprint $table) {

            $table->id('id_egreso');
            $table->dateTime('fecha_egreso');
            $table->string('descripcion_egreso');
            $table->integer('monto_egreso');
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