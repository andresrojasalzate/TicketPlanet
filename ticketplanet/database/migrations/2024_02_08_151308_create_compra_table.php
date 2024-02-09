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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('email');
            $table->date('date');
            $table->time('time');
            $table->string('ticket_name');
            $table->integer('ticket_quantity');
            $table->foreignId('session_id')->references('id')->on('sessions')->onDelete('cascade')
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
        Schema::dropIfExists('compra');
    }
};
