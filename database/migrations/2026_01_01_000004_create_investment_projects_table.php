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
        Schema::create('investment_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investment_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('governorate_id')->constrained()->cascadeOnDelete();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->string('title_en');
            $table->string('title_ar');
            $table->text('brief_description_en');
            $table->text('brief_description_ar');
            $table->longText('full_details_en');
            $table->longText('full_details_ar');
            $table->decimal('required_capital', 15, 2);
            $table->string('currency', 10)->default('USD');
            $table->string('capital_tier');
            $table->decimal('expected_profit_rate_min', 5, 2)->nullable();
            $table->decimal('expected_profit_rate_max', 5, 2)->nullable();
            $table->unsignedInteger('expected_return_period_months')->nullable();
            $table->string('location_description_en')->nullable();
            $table->string('location_description_ar')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('is_quick_return')->default(false);
            $table->string('image_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('investment_category_id');
            $table->index('governorate_id');
            $table->index('city_id');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_projects');
    }
};
