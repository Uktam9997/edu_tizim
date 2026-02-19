<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function financial_save(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'paid_sum'   => 'required|numeric|min:0',
        ]);

        // yangi to‘lov yozuvi
        $payment = Payment::create([
            'student_id' => $validated['student_id'],
            'amount'     => $validated['paid_sum'],
            'paid_at'    => now(),
            'comment'    => $request->comment ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => "To‘lov saqlandi",
            'payment' => $payment,
        ]);
    }


    
    public function student_update_payment(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'field' => 'required|string',
            'value' => 'required'
        ]);

        $student = Student::findOrFail($request['student_id']);
        $field = $request['field'];

        if (in_array($field, ['course_price','debt1','debt2','paid_sum'])) {
            $student->$field = $request['value'];
            $student->save();
        }

        return response()->json(['success'=>true,'student'=>$student]);
    }



    public function student_update_comment(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'comment' => 'nullable|string|max:1000'
        ]);

        $student = Student::findOrFail($request['student_id']);
        $student->comment = $request['comment'];
        $student->save();

        return response()->json([
            'success' => true,
            'message' => 'Izoh yangilandi',
            'student' => $student
        ]);
    }

}
