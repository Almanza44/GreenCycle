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
        //
        Schema::table('trees' , function (Blueprint $table){
            $table->timestamp('last_care_at')->nullable();
            $table->timestamp('harvested_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('trees', function (Blueprint $table){
             $table->dropColumn(['last_care_at', 'harvested_at']);
        });
    }
};
