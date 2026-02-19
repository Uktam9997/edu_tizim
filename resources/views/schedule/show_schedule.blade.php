@extends('layout.header_footer')

@section('content')
<table class="schedule-table">
    <thead>
        <tr>
            <th>Hona</th>
            @foreach($timeslots as $t)
                <th>{{ $t->day_type }}<br>{{ $t->start_time }} - {{ $t->end_time }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($rooms as $room)
        <tr>
            <td>{{ $room->room_name }}</td>
            @foreach($timeslots as $slot)
                @php
                    $cell = $schedules->where('room_id', $room->id)
                                      ->where('timeslot_id', $slot->id)
                                      ->first();
                @endphp
                <td>
                    @if($cell)
                        <div>
                            <strong>{{ optional($cell->teacher)->fullname }}</strong><br>
                            <small>{{ optional($cell->subject)->subject_name }}</small><br>
                            <form action="{{ route('schedule.schedule_delete', $cell->id) }}" method="POST" onsubmit="return confirm('O‘chirishni tasdiqlang');">
                                @csrf
                                <button type="submit">O‘chirish</button>
                            </form>
                        </div>
                    @endif
                </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
