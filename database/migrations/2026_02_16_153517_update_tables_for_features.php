<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Añadir campo de Rol a usuarios
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('usuario'); // Valores: 'admin', 'usuario'
        });

        // Añadir campos multimedia a productos
        Schema::table('productos', function (Blueprint $table) {
            $table->string('imagen')->nullable();     // Para la foto
            $table->string('ficha_tecnica')->nullable(); // Para el PDF
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
