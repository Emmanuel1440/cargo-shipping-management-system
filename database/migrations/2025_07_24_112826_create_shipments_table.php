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
    Schema::create('shipments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('cargo_id');
        $table->unsignedBigInteger('ship_id');
        $table->date('departure_date');
        $table->date('arrival_date')->nullable();
        $table->string('status')->default('scheduled'); // scheduled, departed, arrived, cancelled
        $table->timestamps();

        $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
        $table->foreign('ship_id')->references('id')->on('ships')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
