<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('items_tbl', function (Blueprint $table) {
            $table->string('property')->nullable();  // Adding the new column with null allowed
        });
    }
    
    public function down()
    {
        Schema::table('items_tbl', function (Blueprint $table) {
            $table->dropColumn('property');  // Dropping the column if rolled back
        });
    }
    
};
