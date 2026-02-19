@extends('layout.header_footer')
@section('content')
<link rel="stylesheet" href="{{ asset('css/subject_edit.css') }}">

<form action="{{route('subject.subject_update', $subject->id)}}" method="post">
    @csrf
    <label for="name">Subject Name:</label>
    <input type="text" id="name" name="name" value="{{ $subject->subject_name }}" required><br><br>

    <button type="submit">Update Subject</button>
</form>
@endsection