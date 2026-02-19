@extends('layout.header_footer')
@section('content')

<link rel="stylesheet" href="{{ asset('css/group_create.css') }}">

<form action="{{ route('group.group_store') }}" method="post">
    @csrf
    <!-- Teacher select -->
    <label for="teacher_id">O'qituvchi tanlang:</label>
    <select name="teacher_id" id="teacher_id" required>
        <option value="" disabled selected>O'qituvchini tanlang</option>
        @foreach($teachers as $teacher)
        <option value="{{ $teacher->id }}">{{ $teacher->fullname }}</option>
        @endforeach
    </select>
    <br><br>

    <!-- Subject select -->
    <label for="subject_id">Fanni tanlang:</label>
    <select name="subject_id" id="subject_id" required>
        <option value="" disabled selected>Fanni Tanlang</option>
        @foreach($subjects as $subject)
        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
        @endforeach
    </select>
    <br><br>

    <!-- Group Name input -->
    <label for="group_name">Gruxga nom bering:</label>
    <input type="text" name="group_name" id="group_name" required placeholder="Grux nomi">
    <br><br>

    <button type="submit">Grux yaratish</button>
</form>
@endsection