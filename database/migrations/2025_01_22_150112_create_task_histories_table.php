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
        Schema::create('task_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->char('minutes', 10)->nullable();
            $table->text('description')->nullable();
            $table->enum('task_history_status', ['Paused','Started','Stoped','Finished','Canceled'])->default('Started');
            $table->enum('register_status', ['Enabled', 'Disabled'])->default('Enabled');
            $table->unsignedInteger('task_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_histories');
    }
};
