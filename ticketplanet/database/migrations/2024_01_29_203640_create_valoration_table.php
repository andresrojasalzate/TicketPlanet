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
        Schema::create('valoration', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('caraSeleccionada');
            $table->integer('puntuacionSeleccionada');
            $table->string('tituloComentario')->nullable();
            $table->text('comentario')->nullable();
            $table->foreignId('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valoration');
    }
};
