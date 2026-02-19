<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;


    protected $fillable = [
        'subject_name'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'subject_id', 'id');
    }


}
