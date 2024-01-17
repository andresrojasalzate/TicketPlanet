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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('site');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('image');
            $table->string('description');
            $table->date('finishDate');
            $table->time('finishTime');
            $table->boolean('visible');
            $table->integer('capacity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
