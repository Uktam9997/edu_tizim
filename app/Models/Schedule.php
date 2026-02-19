<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'timeslot_id',
        'subject_id',
        'teacher_id',
        'group_id'
    ];


    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function timeslot()
    {
        return $this->belongsTo(Timeslot::class, 'timeslot_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    
}
