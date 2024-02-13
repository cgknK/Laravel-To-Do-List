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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description');
            $table->unsignedBigInteger('note_user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('is_remember')->default(0);
            $table->dateTime('remember_date')->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
