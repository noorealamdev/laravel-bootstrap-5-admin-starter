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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->longText('html')->nullable();
            $table->longText('shopify')->nullable();
            $table->longText('react')->nullable();
            $table->integer('price')->nullable();
            $table->text('tags')->nullable();
            $table->text('screenshot')->nullable();
            $table->boolean('is_active')->nullable();
            $table->boolean('is_featured')->nullable();
            $table->boolean('has_image')->nullable();
            $table->integer('liked')->nullable();
            $table->integer('views')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
