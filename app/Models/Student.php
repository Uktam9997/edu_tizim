<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'phone',
        'birth_date',
        'join_date',
        'level',
        'course_price',
        'debt1',
        'debt2',
        'paid_sum',
        'comment',
    ];

    
    
    public function groups() {
        return $this->belongsToMany(Group::class, 'group_student')
            ->withPivot('join_date', 'status', 'comment');
    }



    public function subjects() {
        return $this->belongsToMany(Subject::class, 'group_student')
            ->withPivot('join_date', 'status', 'comment');
    }



    public function attendances(){
        return $this->hasMany(Attendance::class, 'student_id', 'id');
    }




    public function payments() {
        return $this->hasMany(Payment::class);
    }

}


