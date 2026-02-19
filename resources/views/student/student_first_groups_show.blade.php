@extends('layout.header_footer')
@section('content')

<link rel="stylesheet" href="{{ asset('css/student_first_groups_show.css') }}"> 
    <h4>{{ $student->fullname }}</h4>

    <form action="{{ route('student.student_update_group', $student->id) }}" method="POST">
        @csrf

        @for ($i = 0; $i < 3; $i++)
            <select name="group_ids[{{ $i }}]">
                <option value="" {{ !isset($studentGroupIds[$i]) ? 'selected' : '' }}>
                    {{ $i + 1 }} - Gruxni tanlang
                </option>
                <option value="remove">❌ Guruhdan chiqish</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}"
                        {{ isset($studentGroupIds[$i]) && $studentGroupIds[$i] == $group->id ? 'selected' : '' }}>
                        {{ $group->group_name }}
                    </option>
                @endforeach
            </select>
            <br><br>
        @endfor

        <button type="submit">Update Groups</button>
    </form>

@endsection