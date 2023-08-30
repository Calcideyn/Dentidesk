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
        Schema::create('EGRESOS', function (Blueprint $table) {

            $table->id('id_egresos');
            $table->dateTime('fecha_egresos');
            $table->string('descripcion_egresos');
            $table->integer('monto_egresos');
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
