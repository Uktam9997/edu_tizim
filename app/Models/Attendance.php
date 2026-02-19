<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
    'student_id',    // talabaga bog‘lanadi
    'group_id',      // guruhga bog‘lanadi
    'lesson_date',   // 1-12 or specific lesson index
    'status',        // 0 = kelmagan, 1 = kech, 2 = to‘liq qatnashgan
    'date',          // dars kuni
    ];


    // Har bir attendance -> student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    // Har bir attendance -> group
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
