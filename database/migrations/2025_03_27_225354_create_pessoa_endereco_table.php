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
        Schema::create('pessoa_endereco', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pes_id')->nullable();
            $table->foreign('pes_id')->references('pes_id')->on('pessoa');
            
            $table->unsignedBigInteger('end_id')->nullable();
            $table->foreign('end_id')->references('end_id')->on('endereco');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endereco_pessoa');
    }
};
