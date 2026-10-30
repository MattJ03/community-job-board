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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('title');
            $table->string('location');
            $table->integer('years_of_experience');
            $table->text('requirements');
            $table->text('description');
            $table->string('minimum_qualification');
            $table->string('work_from');
            $table->decimal('salary')->nullable();
            $table->decimal('hourly')->nullable();
            $table->string('status')->default('open');
            $table->unsignedBigInteger('views');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
