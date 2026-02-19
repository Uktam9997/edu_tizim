<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;


    protected $fillable = [
        'fullname',
        'phone'
    ];


    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'teacher_id', 'id');
    }


    public function groups()
    {
        return $this->hasMany(Group::class, 'teacher_id', 'id');
    }

}
