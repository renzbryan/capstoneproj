<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcitems', function (Blueprint $table) {
            $table->id(); // Automatically creates an auto-incrementing 'id' column
            $table->foreignId('property_id')->constrained()->onDelete('cascade'); // Foreign key to Property table
            $table->foreignId('iar_id')->constrained()->onDelete('cascade'); // Foreign key to IAR table
            $table->string('reference')->nullable(); // Reference field
            $table->decimal('receipt_qty', 10, 2)->nullable(); // Receipt quantity
            $table->decimal('issue_qty', 10, 2)->nullable(); // Issue quantity
            $table->string('issue_office')->nullable(); // Issue office
            $table->decimal('balance_qty', 10, 2)->nullable(); // Balance quantity
            $table->decimal('amount', 10, 2)->nullable(); // Amount
            $table->text('remarks')->nullable(); // Remarks
            $table->date('date')->nullable(); // Date field
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pcitems');
    }
}
