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
        Schema::table('discount_checks', function (Blueprint $table) {
            $table->enum('status', ['pending', 'accepted', 'cancelled'])->default('pending')->after('discount_id');
            $table->text('comment')->nullable()->after('status');
            $table->decimal('price', 10, 2)->nullable()->after('comment');
            $table->decimal('final_price', 10, 2)->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('discount_checks', function (Blueprint $table) {
            $table->dropColumn(['status', 'comment', 'price', 'final_price']);
        });
    }
};
