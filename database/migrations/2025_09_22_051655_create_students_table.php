<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('join_date');
            $table->string('level')->nullable();         // kurs darajasi
            $table->decimal('course_price', 12, 2)->default(0);
            $table->decimal('debt1', 12, 2)->default(0);
            $table->decimal('debt2', 12, 2)->default(0);
            $table->decimal('paid_sum', 12, 2)->default(0);
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
