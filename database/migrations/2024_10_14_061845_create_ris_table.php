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
        Schema::create('ris', function (Blueprint $table) {
            $table->id();
            $table->string('entity_name');
            $table->string('fundcluster');
            $table->string('division');
            $table->string('office');
            $table->string('rcc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ris');
    }
};
