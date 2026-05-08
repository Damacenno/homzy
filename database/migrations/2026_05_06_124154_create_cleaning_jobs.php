<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cleaning_jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id');
            $table->integer('cleaner_user_id')->nullable();
            $table->dateTime('scheduled_at')->nullable();
            $table->json('tasks')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->integer('status_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleaning_jobs');
    }
};
