<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    
    public function teacher_show(){

        $teachers = Teacher::all();
        return view('teacher.teacher_show', compact('teachers'));
    }   



    public function teacher_create(){
        return view('teacher.teacher_create');
    }



    public function teacher_store(Request $request){
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        Teacher::create([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
        ]);

        return redirect()->route('teacher.teacher_show')->with('success', 'Teacher created successfully.');
    }


    public function teacher_edit($id){
        $teacher = Teacher::findOrFail($id);
        return view('teacher.teacher_edit', compact('teacher'));
    }



    public function teacher_update(Request $request, $id){
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
        ]);

        return redirect()->route('teacher.teacher_show')->with('success', 'Teacher updated successfully.');
    }



    public function teacher_delete($id){
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teacher.teacher_show')->with('success', 'Teacher deleted successfully.');
    }

    
}
