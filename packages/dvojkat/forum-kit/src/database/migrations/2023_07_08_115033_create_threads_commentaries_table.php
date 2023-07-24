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
        Schema::create('thread_commentaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Автор комментария');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->morphs('commentable');
            $table->text('text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thread_commentaries');
    }
};
