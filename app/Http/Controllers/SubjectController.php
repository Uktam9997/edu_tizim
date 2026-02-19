<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    
    public function subject_show() {
        $subjects = Subject::all();
        return view('subject.subject_show', compact('subjects'));
    }


    public function subject_create() {
        return view('subject.subject_create');
    }


    public function subject_store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Subject::create([
            'subject_name' => $request->name,
        ]);

        return redirect()->route('subject.subject_show')->with('success', 'Subject created successfully.');
    }


    public function subject_edit($id) {
        $subject = Subject::findOrFail($id);
        return view('subject.subject_edit', compact('subject'));
    }


    public function subject_update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update([
            'subject_name' => $request->name,
        ]);

        return redirect()->route('subject.subject_show')->with('success', 'Subject updated successfully.');
    }


    public function subject_delete($id) {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subject.subject_show')->with('success', 'Subject deleted successfully.');
    }


}
