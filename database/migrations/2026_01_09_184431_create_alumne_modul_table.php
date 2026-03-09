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
        Schema::create('alumne_modul', function (Blueprint $table) {
            $table->unsignedBigInteger('alumne_id');
            $table->unsignedBigInteger('modul_id');
            $table->foreign('alumne_id')->references('id')->on('alumnes')->onDelete('cascade');
            $table->foreign('modul_id')->references('id')->on('moduls')->onDelete('cascade');
            $table->decimal('nota', 4, 2)->nullable();

            
            $table->primary(['alumne_id', 'modul_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumne_modul');
    }
};
