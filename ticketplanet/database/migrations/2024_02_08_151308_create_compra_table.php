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
            $table->string('emailPurchaser')->nullable();
            $table->string('namePurchaser')->nullable();
            $table->string('dniPurchaser')->nullable();
            $table->string('phonePurchaser')->nullable();
            $table->string('pdfTickets')->nullable();
            $table->foreignId('session_id')->references('id')->on('sessions')->onDelete('cascade')
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
