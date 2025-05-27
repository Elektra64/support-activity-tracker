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
        Schema::create('activity_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->enum('status', ['done', 'pending']);
            $table->text('remark')->nullable();
            $table->string('bio_snapshot');
            $table->timestamps(); 
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_updates');
    }
};
