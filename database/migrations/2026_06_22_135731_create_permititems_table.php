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
        Schema::create('permititems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permit_id')->constrained('permits')->onDelete('cascade');
            $table->string('visistor_name');
            $table->enum('visistor_type',['adult','child']);
            $table->integer('quantity');
            $table->decimal('unit_price',10 ,2);
            $table->decimal('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permititems');
    }
};
