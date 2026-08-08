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
        Schema::create('investment_project_machinery', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investment_project_id')->constrained('investment_projects')->cascadeOnDelete();
            $table->foreignId('machinery_id')->constrained('machinery')->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->string('notes_en')->nullable();
            $table->string('notes_ar')->nullable();
            $table->timestamps();

            $table->unique(['investment_project_id', 'machinery_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_project_machinery');
    }
};
