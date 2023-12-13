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
        //Migración de la tabla de las respuestas
        Schema::create('replies', function (Blueprint $table) {
            //id
            $table->id();

            //Relación consigo misma
            $table->unsignedBigInteger('reply_id')->nullable();
            $table->foreign('reply_id')
                ->references('id')
                ->on('replies')
                ->onDelete('set null');

            //Relación con la pregunta a la que conrresponde
            $table->unsignedBigInteger('thread_id');
            $table->foreign('thread_id')
                ->references('id')
                ->on('threads')
                ->onDelete('cascade');

            //Relación con el usuario que hizo la pregunta
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            //Respuesta
            $table->text('body');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
