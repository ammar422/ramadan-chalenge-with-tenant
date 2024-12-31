<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('sort')->nullable();
            $table->string('image');
            $table->decimal('price_target', 65, 2);
            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();
            $table->integer('total_days');
            $table->string('video_url');
            $table->integer('total_donors')->default(0);
            $table->decimal('total_amount', 65, 2)->default(0);
            $table->enum('status', ['pending', 'published', 'ended', 'completed', 'cancelled']);
            $table->enum('is_public', ['yes', 'no'])->default('no');

            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('currency_id')->constrained('countries')->cascadeOnDelete()->cascadeOnUpdate();
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
