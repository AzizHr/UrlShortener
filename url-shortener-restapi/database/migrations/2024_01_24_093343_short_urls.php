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
        Schema::create('short_urls', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->integer('clicks')->default(0);
            $table->unsignedBigInteger('long_url_id'); 
            $table->foreign('long_url_id')->references('id')
            ->on('long_urls')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('short_urls');
    }
};
