<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('group_student', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                  ->constrained('students')
                  ->cascadeOnDelete();

            $table->foreignId('group_id')
                  ->constrained('groups')
                  ->cascadeOnDelete();

            $table->date('join_date')
                  ->default(DB::raw('CURRENT_DATE'));

            $table->enum('status', ['active', 'inactive', 'completed'])
                  ->default('active')
                  ->index();

            $table->string('comment')
                  ->nullable();

            $table->timestamps();

            // duplicate yozuvni oldini olish
            $table->unique(['student_id', 'group_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_student');
    }
};
