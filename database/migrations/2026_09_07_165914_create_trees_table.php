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
        Schema::create('trees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('seed_type_id')->constrained();
            $table->string('name');
            $table->integer('level')->default(0);
            $table->integer('health')->default(100);
            $table->integer('progress')->default(0);
            $table->enum('status', ['ACTIVE', 'MATURE', 'DEAD', 'HARVESTED'])->default('ACTIVE');
            $table->timestamp('next_care_at')->nullable();
            $table->timestamp('last_deterioration_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trees');
    }
};
