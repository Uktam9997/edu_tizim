@extends('layout.header_footer')
@section('content')

<link rel="stylesheet" href="{{ asset('css/student_edit.css') }}">
<form action="{{ route('student.student_update', $student->id) }}" method="post">
    @csrf

    <!-- Group select -->
    <label for="group_id">Select Group:</label>
    <select name="group_id" id="group_id" required>
        <option value="" disabled>Select Group</option>
        @foreach($groups as $group)
        <!-- gruxni tanlang -->
        <option value="{{ $group->id }}" {{ $student->group_id == $group->id ? 'selected' : '' }}>
            {{ $group->group_name }}
        </option>
        @endforeach
    </select>
    <br><br>

    <!-- Student Name input -->
    <label for="student_name">Student Name:</label>
    <input type="text" name="fullname" id="fullname" required placeholder="O'quvchining: F.I.O" value="{{ $student->fullname }}">
    <br><br>

    <!-- Student Phone input -->
    <label for="student_phone">Student Phone:</label>
    <input type="text" name="phone" id="phone" placeholder="Tel:+998" value="{{ $student->phone }}">
    <br><br>

    <!-- Birth Date input -->
    <label for="birth_date">Birth Date:</label>
    <input type="date" name="birth_date" id="birth_date" value="{{ $student->birth_date }}">
    <br><br>

    <!-- Join Date input -->
    <label for="join_date">Join Date:</label>
    <input type="date" name="join_date" id="join_date" required value="{{ $student->join_date }}">
    <br><br>

    <!-- Level input -->
    <label for="level">Level:</label>
    <input type="text" name="level" id="level" placeholder="O'quvchining darajasi" value="{{ $student->level }}">
    <br><br>

    <!-- Course Price input -->
    <label for="course_price">Course Price:</label>
    <input type="number" name="course_price" id="course_price" required min="0" step="0.01" value="{{ $student->course_price }}">
    <br><br>

    <!-- Paid Sum input -->
    <label for="paid_sum">Paid Sum:</label>
    <input type="number" name="paid_sum" id="paid_sum" min="0" step="0.01" value="{{ $student->paid_sum }}">
    <br><br>

    <!-- Debt1 -->
    <label for="debt1">Debt1:</label>
    <input type="number" name="debt1" id="debt1" min="0" step="0.01" value="{{ $student->debt1 }}">
    <br><br>

    <!-- Debt2 -->
    <label for="debt2">Debt2:</label>
    <input type="number" name="debt2" id="debt2" min="0" step="0.01" value="{{ $student->debt2 }}">
    <br><br>

    <!-- Comment -->
    <label for="comment">Comment:</label>
    <input type="text" name="comment" id="comment" placeholder="Izoh" value="{{ $student->comment }}">
    <br><br>

    <button type="submit">Update Student</button>
</form>
@endsection