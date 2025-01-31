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
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('url_course');
            $table->date('start_date');
            $table->date('end_date');
            $table->char('minutes', 10);
            $table->enum('difficulty_level', ['High','Medium','Low']);
            $table->enum('priority', ['High','Medium','Low']);
            $table->enum('task_status', ['Paused','Started','Stoped','Finished']);
            $table->enum('register_status', ['Enabled', 'Disabled']);
            $table->unsignedInteger('client_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
