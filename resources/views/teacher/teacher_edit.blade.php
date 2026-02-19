@extends('layout.header_footer')
@section('content')

<link rel="stylesheet" href="{{ asset('css/teacher_edit.css') }}">

<form action="{{ route('teacher.teacher_update', $teacher->id) }}" method="post">
    @csrf
    <label for="fullname">Full Name:</label>
    <input type="text" id="fullname" name="fullname" value="{{ $teacher->fullname }}" required><br><br>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" value="{{ $teacher->phone }}"><br><br>

    <button type="submit">Update Teacher</button>
</form>

@endsection