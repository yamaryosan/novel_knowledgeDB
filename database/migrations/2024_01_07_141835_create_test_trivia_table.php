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
        Schema::create('test_trivia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255)->comment('タイトル');
            $table->text('summary')->comment('総論');
            $table->text('detail')->comment('詳細');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_trivia');
    }
};
