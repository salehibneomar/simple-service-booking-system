<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ServiceStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->double('price')->default(0.0);
            $table->enum('status', ServiceStatus::values())
                ->default(ServiceStatus::AVAILABLE->value)
                ->comment('1: Available, 0: Not Available');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
