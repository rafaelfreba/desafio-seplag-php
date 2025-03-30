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
        Schema::table('endereco', function (Blueprint $table) {
           
            $table->unsignedBigInteger('cid_id')->nullable();
            $table->foreign('cid_id')->references('cid_id')->on('cidade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropForeign(['cid_id']);
            $table->dropColumn('cid_id');
        });
    }
};