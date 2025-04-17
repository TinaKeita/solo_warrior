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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            // Šeit definējam student_id un sasaistām to ar 'users' tabulu
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Ja priekšmeti ir saistīti ar 'subjects' tabulu, tad:
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->integer('grade');
            $table->timestamp('graded_at')->useCurrent(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
