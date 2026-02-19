<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');

            $table->foreignId('teacher_id')
                  ->constrained('teachers')
                  ->cascadeOnDelete();

            $table->foreignId('subject_id')
                  ->nullable()
                  ->constrained('subjects')
                  ->nullOnDelete();

            // 🔽 Status qismi qo‘shildi
            $table->enum('status', ['active', 'inactive', 'archived'])
                  ->default('active')
                  ->index();

            $table->timestamp('closed_at')
                  ->nullable()
                  ->index();

            $table->string('closed_reason')
                  ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
