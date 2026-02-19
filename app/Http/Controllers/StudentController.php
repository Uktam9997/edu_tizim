<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function student_show() {
        $students = Student::with('groups') // guruhlarini ham yuklaymiz
            ->orderBy('fullname', 'asc')
            ->get();
            // dd($students->first()->groups);
        return view('student.student_show', compact('students'));
    }



    public function student_create() {
        $groups = Group::orderBy('group_name', 'asc')->get();
        return view('student.student_create', compact('groups'));
    }



    public function student_store(Request $request) {
        // dd($request->all());

        $request->validate([
            'fullname' => 'required|max:100',
            'phone' => 'nullable|max:20',
            'join_date' => 'required|date',
            'level' => 'nullable|max:50',
            'course_price' => 'required|numeric|min:0',
            'paid_sum' => 'nullable|numeric|min:0',
            'comment' => 'nullable|max:255',
        ]);

        $res = Student::create([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'join_date' => $request->join_date,
            'level' => $request->level,
            'course_price' => $request->course_price,
            'paid_sum' => $request->paid_sum,
            'comment' => $request->comment,
        ]);

        if($res && $request->group_id) {
            $student = Student::find($res->id);
            $student->groups()->attach($request->group_id, [
                'join_date' => now(),
                'status' => 'active',
            ]);
        }

        return redirect()->route('student.student_show')->with('success', 'Student created successfully.');
    }


    public function student_edit($id) {
        $student = Student::find($id);
        $groups = Group::orderBy('group_name', 'asc')->get();
        return view('student.student_edit', compact('student', 'groups'));
    }


    public function student_update(Request $request, $id) {
        // dd($request->all());

        $request->validate([
            'fullname' => 'required|max:100',
            'phone' => 'nullable|max:20',
            'join_date' => 'required|date',
            'level' => 'nullable|max:50',
            'course_price' => 'required|numeric|min:0',
            'debt1' => 'nullable|numeric|min:0',
            'debt2' => 'nullable|numeric|min:0',
            'paid_sum' => 'nullable|numeric|min:0',
            'comment' => 'nullable|max:255',
        ]);

        $student = Student::find($id);
        $student->fullname = $request->fullname;
        $student->phone = $request->phone;
        $student->join_date = $request->join_date;
        $student->level = $request->level;
        $student->course_price = $request->course_price;
        $student->paid_sum = $request->paid_sum;
        $student->debt1 = $request->debt1;
        $student->debt2 = $request->debt2;
        $student->comment = $request->comment;
        $student->save();

        if($request->group_id) {
            // Detach from all groups
            $student->groups()->detach();
            // Attach to the selected group
            $student->groups()->attach($request->group_id, [
                'join_date' => now(),
                'status' => 'active',
            ]);
        } else {
            // If no group is selected, detach from all groups
            $student->groups()->detach();
        }

        return redirect()->route('student.student_show')->with('success', 'Student updated successfully.');
    }



    public function student_delete($id) {
        $student = Student::find($id);
        if($student) {
            // Detach from all groups
            $student->groups()->detach();
            $student->delete();
            return redirect()->route('student.student_show')->with('success', 'Student deleted successfully.');
        }
        return redirect()->route('student.student_show')->with('error', 'Student not found.');
    }



    public function student_first_groups_show($id) {
        $student = Student::with('groups')->find($id);
        if(!$student) {
            return redirect()->route('student.student_show')->with('error', 'Student not found.');
        }

        $groups = Group::all(); // barcha guruhlar
        $studentGroupIds = $student->groups->pluck('id')->toArray(); // talabaga bog'langan guruhlar

        return view('student.student_first_groups_show', compact('student', 'groups', 'studentGroupIds'));
    }



   public function student_update_group(Request $request, $student_id) {
        $student = Student::with('groups')->find($student_id);
        if(!$student) {
            return redirect()->route('student.student_show')->with('error', 'Student not found.');
        }

        $groupSelections = $request->input('group_ids', []);
        $oldGroupIds = $student->groups->pluck('id')->toArray();

        foreach ($groupSelections as $index => $group_id) {
            if ($group_id === "remove") {
                // Eski guruhni index bo‘yicha aniqlaymiz
                $oldGroupId = $oldGroupIds[$index] ?? null;
                if ($oldGroupId) {
                    $student->groups()->detach($oldGroupId);
                }
            } elseif (!empty($group_id)) {
                // Yangi guruhni qo‘shamiz (detach qilmasdan)
                $student->groups()->syncWithoutDetaching([
                    $group_id => [
                        'join_date' => now(),
                        'status' => 'active',
                    ]
                ]);
            }
            // Agar value "" bo‘lsa (ya’ni "tanlanmagan") – hech narsa qilinmaydi
        }

        return redirect()->route('student.student_show')->with('success', 'Student groups updated successfully.');
    }



    public function search(Request $request)
    {
        $q = $request->get('q');

        // O'quvchilarni qidirish va barcha guruhlarini yuklash
        $students = Student::with('groups')
            ->where('fullname', 'like', "%{$q}%")
            ->orWhere('phone', 'like', "%{$q}%")
            ->limit(10)
            ->get();

        // JSON formatida qaytarish
        return response()->json($students->map(function($student) {
            return [
                'id' => $student->id,
                'fullname' => $student->fullname,
                'phone' => $student->phone,
                'groups' => $student->groups->map(function($group) {
                    return [
                        'id' => $group->id,
                        'group_name' => $group->group_name
                    ];
                }),
            ];
        }));
    }



   
    public function update_field(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'field'      => 'required|string',
            'value'      => 'required',
        ]);

        $student = Student::find($request->student_id);
        $field = $request->field;
        $value = $request->value;

        // ruxsat berilgan fieldlar
        $allowedFields = ['course_price', 'debt1', 'debt2', 'paid_sum'];
        if (!in_array($field, $allowedFields)) {
            return response()->json(['success' => false, 'message' => 'Not allowed field']);
        }

        $student->$field = $value;
        $student->save();

        return response()->json(['success' => true, 'student' => $student]);
    }


    
    


}

