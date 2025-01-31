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
        Schema::create('deparments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('short_name');
            $table->text('description')->nullable();
            $table->enum('register_status', ['Enabled', 'Disabled']);
            $table->unsignedInteger('institution_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deparments');
    }
};
