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
        Schema::create('crews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ship_id')->nullable()->constrained('ships')->nullOnDelete();
    
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('role', [
                'Captain', 'Engineer', 'Cook', 'Chief Officer', 'Able Seaman',
                'Ordinary Seaman', 'Engine Cadet', 'Radio Officer', 'Chief Cook',
                'Steward', 'Deckhand'
            ])->default('Captain');
            
         
            $table->string('phone_number')->unique();
            $table->string('nationality')->nullable();
            $table->boolean('is_active')->default(true);
    
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crews');
    }
};
