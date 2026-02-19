<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_name',
        'teacher_id',
        'subject_id',
        'status',         // faol / yopilgan holati
        'closed_at',      // yopilgan sana
        'closed_reason',  // sabab
    ];

    protected $casts = [
        'closed_at' => 'datetime',
    ];

    /* =======================
     |  Munosabatlar
     |======================= */

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }



    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }



    public function students() {
        return $this->belongsToMany(Student::class, 'group_student')
            ->withPivot('join_date', 'status', 'comment');
    }



    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /* =======================
     |  Scopelar
     |======================= */

    // Faqat faol (active) guruhlarni olish
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Faqat yopilgan (inactive) guruhlar
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /* =======================
     |  Holatni boshqarish
     |======================= */

    public function activate(): void
    {
        $this->update([
            'status'        => 'active',
            'closed_at'     => null,
            'closed_reason' => null,
        ]);
    }



    public function deactivate(?string $reason = null): void
    {
        $this->update([
            'status'        => 'inactive',
            'closed_at'     => now(),
            'closed_reason' => $reason,
        ]);
    }

    
}
