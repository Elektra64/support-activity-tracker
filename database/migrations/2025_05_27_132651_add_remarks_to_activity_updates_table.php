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
        Schema::table('activity_updates', function (Blueprint $table) {
            $table->text('remarks')->nullable()->after('user_id');
            $table->text('bio_snapshot')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_updates', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
    }
};
