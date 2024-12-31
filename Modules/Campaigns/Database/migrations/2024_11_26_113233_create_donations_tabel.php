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
        Schema::create('donations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->enum('love_donation', ['yes', 'no']);
            $table->string('love_name')->nullable();
            $table->string('love_email')->nullable();
            $table->string('love_mobile')->nullable();
            $table->longText('love_comment')->nullable();
            $table->foreignUuid('currency_id')->constrained('countries')->cascadeOnDelete()->cascadeOnUpdate();

            $table->decimal('amount', 65, 2);
            $table->enum('ongoing_charity', ['yes', 'no']);

            $table->decimal('charity_amount', 65, 2);
            $table->decimal('total_amount', 65, 2);

            $table->decimal('total_myr', 65, 2)->default(0);
            $table->decimal('myr_rate', 10, 2)->default(0);

            $table->string('usd_rate');
            $table->string('total_usd');

            $table->string('gateway')->nullable();
            $table->longText('gateway_url')->nullable();

            $table->string('reference_id')->nullable();
            $table->json('transaction_json')->nullable();

            $table->enum('status', ['pending', 'done', 'cancelled', 'rejected']);

            $table->foreignUuid('campaign_id')->constrained('campaigns')->cascadeOnDelete()->cascadeOnUpdate();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
