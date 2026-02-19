@extends('layout.header_footer')
@section('content')

<link rel="stylesheet" href="{{ asset('css/subject_create.css') }}">

<form action="{{route('subject.subject_store')}}" method="post">
    @csrf
    <label for="name">Subject Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <button type="submit">Create Subject</button>
</form>

@endsection