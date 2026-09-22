<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('return_books', function (Blueprint $table) {
            $table->id();

            $table->foreignId('loan_id')
                  ->unique()
                  ->constrained('loans')
                  ->cascadeOnDelete();

            $table->date('return_date');

            $table->integer('late_days')->default(0);

            $table->decimal('fine', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('return_books');
    }
};