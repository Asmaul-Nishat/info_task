<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('parent1_name')->nullable();
            $table->string('parent1_phone')->nullable();

            $table->string('parent2_name')->nullable();
            $table->string('parent2_phone')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'parent1_name',
                'parent1_phone',
                'parent2_name',
                'parent2_phone',
            ]);
        });
    }
};