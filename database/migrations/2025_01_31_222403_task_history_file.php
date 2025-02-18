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
        Schema::create('task_histories_files', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->string('url_file');
            $table->unsignedInteger('task_history_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('task_history_id')->references('id')->on('task_histories')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_histories_files');
    }
};
