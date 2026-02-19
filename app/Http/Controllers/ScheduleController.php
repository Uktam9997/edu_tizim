<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Timeslot;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    
   public function index()
    {
        $rooms = Room::all();
        $timeslots = Timeslot::orderBy('day_type')
            ->orderBy('start_time')
            ->get();

        // загружаем связи, а не ID
        $schedules = Schedule::with(['room', 'timeslot', 'subject', 'teacher'])->get();

        return view('schedule.show_schedule', compact('rooms', 'timeslots', 'schedules'));
    }



    public function create()
    {
        $teachers = Teacher::all();
        // dd($teachers);
        $subjects = Subject::all();
        $groups = Group::all();
        $rooms = Room::all();
        $timeslots = Timeslot::orderBy('day_type')
            ->orderBy('start_time')
            ->get();
        return view('schedule.schedule_create', compact('rooms', 'timeslots', 'teachers', 'subjects', 'groups'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'group_id' => 'required|exists:groups,id',
            'room_id' => 'required|exists:rooms,id',
            'timeslot_id' => 'required|exists:timeslots,id',
        ]);

         // Xona va vaqt bandligini tekshirish
        $exists = Schedule::where('room_id', $request->room_id)
            ->where('timeslot_id', $request->timeslot_id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['error' => 'Bu xona ushbu vaqtda allaqachon band!']);
        }

        Schedule::create($request->all());

        return redirect()->route('schedule.show_schedule')
            ->with('success', 'Dars jadvali muvaffaqiyatli yaratildi.');
    }



    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedule.show_schedule')
            ->with('success', 'Dars jadvali muvaffaqiyatli o\'chirildi.');
    }

}
