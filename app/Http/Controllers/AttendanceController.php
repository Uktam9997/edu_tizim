<?php


namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Group;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function attendance_save(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'group_id' => 'required|exists:groups,id',
            'lesson_date' => 'required|date',
            'status' => 'nullable|string|max:1',
        ]);

        $attendance = Attendance::updateOrCreate(
            [
                'student_id' => $request['student_id'],
                'group_id' => $request['group_id'],
                'lesson_date' => $request['lesson_date']
            ],
            ['status' => $request['status']]
        );

        return response()->json(['success'=>true,'attendance'=>$attendance]);
    }

    public function lesson_date_update(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'old_date' => 'required|date',
            'new_date' => 'required|date',
        ]);

        $attendances = Attendance::where('group_id', $request['group_id'])
                                 ->where('lesson_date', $request['old_date'])
                                 ->get();

        foreach ($attendances as $attendance) {
            $attendance->lesson_date = $request['new_date'];
            $attendance->save();
        }

        return response()->json(['success'=>true,'new_date'=>$request['new_date']]);
    }


     public function clone_previous_month($group_id)
    {
        $group = Group::findOrFail($group_id);

        // O‘tgan oy
        $prevMonth = now()->subMonth()->month;
        $prevYear = now()->subMonth()->year;

        // O‘tgan oy attendance yozuvlarini olish
        $prevAttendances = Attendance::where('group_id', $group->id)
                                     ->where('month', $prevMonth)
                                     ->where('year', $prevYear)
                                     ->get();

        if($prevAttendances->isEmpty()) {
            return response()->json(['success'=>false,'message'=>"O‘tgan oy uchun attendance topilmadi"]);
        }

        // Yangi oy uchun yozuvlar yaratish
        $newMonth = now()->month;
        $newYear = now()->year;

        foreach($prevAttendances as $att) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $att->student_id,
                    'group_id' => $att->group_id,
                    'lesson_date' => now()->day($att->lesson_date->day), // ayni kun bo‘yicha
                ],
                [
                    'status' => null, // yangi oyda status bo‘sh
                    'month' => $newMonth,
                    'year' => $newYear,
                    'comment' => null
                ]
            );
        }

        return response()->json(['success'=>true,'message'=>"Attendance yozuvlari yangi oyga ko‘chirildi"]);
    }
}
