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
    Schema::create('cargos', function (Blueprint $table) {
        $table->id();
        $table->string('description');
        $table->float('weight');
        $table->string('type');
        $table->foreignId('client_id')->constrained()->onDelete('cascade');
        $table->foreignId('origin_port')->constrained('ports')->onDelete('cascade');
        $table->foreignId('destination_port')->constrained('ports')->onDelete('cascade');
        $table->enum('status', ['in transit', 'delivered', 'pending'])->default('pending');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
