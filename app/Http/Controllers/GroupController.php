<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Group;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    
    public function group_show() {
        $groups = Group::whereIn('status', ['active', 'inactive'])->get();
        return view('group.group_show', compact('groups'));
    }



    public function group_create() {
        $teachers = Teacher::orderBy('fullname', 'asc')->get();
        $subjects = Subject::orderBy('subject_name', 'asc')->get();
        return view('group.group_create', compact('teachers', 'subjects'));
    }



    public function group_store(Request $request) {
        // dd($request->all());

        $request->validate([
            'group_name' => 'required|max:100',
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        Group::create([
            'group_name' => $request->group_name,
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,
        ]);

        return redirect()->route('group.group_show')->with('success', 'Group created successfully.');
    }



    public function group_edit($id) {
        $group = Group::findOrFail($id);
        $teachers = Teacher::orderBy('fullname', 'asc')->get();
        $subjects = Subject::orderBy('subject_name', 'asc')->get();
        return view('group.group_edit', compact('group', 'teachers', 'subjects'));
    }



    public function group_update(Request $request, $id) {
        // dd($request->all());

        $request->validate([
            'group_name' => 'required|max:100',
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'status' => 'required|in:active,inactive,archived',
            'closed_at' => 'nullable|date',
            'closed_reason' => 'nullable|max:255',
        ]);

        $group = Group::findOrFail($id);
        $group->update([
            'group_name' => $request->group_name,
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,
            'status' => $request->status,
            'closed_at' => $request->closed_at,
            'closed_reason' => $request->closed_reason,
        ]);

        return redirect()->route('group.group_show')->with('success', 'Group updated successfully.');
    }


    public function group_delete($id) {
        $group = Group::findOrFail($id);
        $group->delete();
        return redirect()->route('group.group_show')->with('success', 'Group deleted successfully.');
    }



    public function group_archive_show() {
        $archivedGroups = Group::where('status', 'archived')->get();
        return view('group.group_archive_show', compact('archivedGroups'));
    }



    public function group_first_show($id)
    {
        $group = Group::with([
            'teacher',
            'students.attendances' => function ($query) use ($id) {
                $query->where('group_id', $id);
            }
        ])->find($id);

        if (!$group) {
            return redirect()->route('group.group_show')->with('error', 'Group not found.');
        }

        // Guruhdagi mavjud dars sanalari attendances jadvalidan olinadi
        $lesson_dates = Attendance::where('group_id', $id)
            ->orderBy('lesson_date', 'asc')
            ->pluck('lesson_date')
            ->unique()
            ->values()
            ->toArray();

        // Agar hali hech qanday dars bo‘lmasa, 12 ta bo‘sh sana hosil qilamiz
        if (empty($lesson_dates)) {
            for ($i = 0; $i < 12; $i++) {
                $lesson_dates[] = now()->addDays($i)->format('Y-m-d');
            }
        }

        $students = $group->students;

        return view('group.group_first_show', compact('group', 'students', 'lesson_dates'));
    }

}
