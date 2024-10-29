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
        Schema::create('scitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stocks_id');
            $table->string('reorder_point');
            $table->timestamps();
            $table->string('reference');
            $table->integer('receipt_qty');
            $table->integer('issue_qty');
            $table->string('issue_office');
            $table->integer('balance_qty');
            $table->integer('consume');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scitems');
    }
};
