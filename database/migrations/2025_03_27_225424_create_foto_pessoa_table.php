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
        Schema::create('foto_pessoa', function (Blueprint $table) {
            $table->id('fp_id');

            $table->unsignedBigInteger('pes_id')->nullable();
            $table->foreign('pes_id')->references('pes_id')->on('pessoa');

            $table->date('fp_data')->nullable();
            $table->string('fp_bucket', 50)->nullable();
            $table->string('fp_hash', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_pessoa');
    }
};
