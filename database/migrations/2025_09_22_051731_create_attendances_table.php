<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('group_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->date('lesson_date');

            $table->unsignedTinyInteger('status')
                  ->default(0); // 0-kelmagan, 1-bir marta, 2-doimiy

            //  after() olib tashlandi
            $table->integer('month');
            $table->integer('year');

            $table->timestamps();

            $table->unique(['student_id','group_id','lesson_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
