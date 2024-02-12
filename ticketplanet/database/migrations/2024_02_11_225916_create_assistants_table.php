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
        Schema::create('assistants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nameAssistant')->nullable();
            $table->string('dniAssistant')->nullable();
            $table->string('phoneAssistant')->nullable();
            $table->foreignId('compra_id')->references('id')->on('compras')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('ticket_id')->references('id')->on('tickets')->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistants');
    }
};
