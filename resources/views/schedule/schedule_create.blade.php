@extends('layout.header_footer')

@section('content')
<link rel="stylesheet" href="{{ asset('css/schedule_create.css') }}">

<form action="{{ route('schedule.schedule_store') }}" method="POST">
    @csrf
    <label for="room_id">Hona:</label>
    <select name="room_id" id="room_id" required>
        @foreach($rooms as $room)
        <option value="{{ $room->id }}">{{ $room->room_name }}</option>
        @endforeach
    </select><br><br>

    <label for="timeslot_id">Dars vaqti:</label>
    <select name="timeslot_id" id="timeslot_id" required>
        @foreach($timeslots as $slot)
        <option value="{{ $slot->id }}">
            {{ $slot->day_type }}: {{ $slot->start_time }} - {{ $slot->end_time }}
        </option>
        @endforeach
    </select><br><br>

    <label for="teacher_id">O'qituvchi:</label>
    <select name="teacher_id" id="teacher_id" required>
        @foreach($teachers as $teacher)
        <option value="{{ $teacher->id }}">{{ $teacher->fullname }}</option>
        @endforeach
    </select><br><br>

    <label for="subject_id">Fan:</label>
    <select name="subject_id" id="subject_id" required>
        @foreach($subjects as $subject)
        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
        @endforeach
    </select><br><br>

    <label for="group_id">Grux:</label>
    <select name="group_id" id="group_id" required>
        @foreach($groups as $group)
        <option value="{{ $group->id }}">{{ $group->group_name }}</option>
        @endforeach
    </select><br><br>

    <button type="submit">Daris jadvaliga qo'shish</button>
</form>
@endsection