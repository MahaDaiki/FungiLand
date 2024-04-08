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
        Schema::create('collection_content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image');
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
            
        });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_content');
    }
};
