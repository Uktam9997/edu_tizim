@extends('layout.header_footer')
@section('content')

<link rel="stylesheet" href="{{ asset('css/teacher_create.css') }}">

<form action="{{route('teacher.teacher_store')}}" method="post">
    @csrf
    <label for="fullname">Full Name:</label>
    <input type="text" id="fullname" name="fullname" required><br><br>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone"><br><br>

    <button type="submit">Create Teacher</button>
</form>

@endsection