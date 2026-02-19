@extends('layout.header_footer')

@section('content')

<link rel="stylesheet" href="{{ asset('css/group_first_show.css') }}">

<p><strong>O‘qituvchi:</strong> {{ $group->teacher->fullname }}</p>
<p><strong>Guruh:</strong> {{ $group->group_name }}</p>
<p>
    <button id="clone-previous-month" data-group-id="{{ $group->id }}">
        Yangi gurux yaratish
    </button>
</p>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>F.I.O</th>
                <th>Telefon</th>
                <th>Tug‘ilgan sana</th>
                <th>Qabul qilingan sana</th>
                <th>Daraja</th>
                @for($i = 0; $i < 12; $i++)
                    <th>
                    Dars {{ $i + 1 }}<br>
                    <input type="date"
                        class="lesson-date"
                        data-index="{{ $i }}"
                        data-old-date="{{ $lesson_dates[$i] ?? '' }}"
                        value="{{ $lesson_dates[$i] ?? '' }}">
                    </th>
                    @endfor
                    <th>Izox</th>
                    <th>Kurs narxi</th>
                    <th>Qarz 1</th>
                    <th>Qarz 2</th>
                    <th>To‘langan summa</th>
            </tr>
        </thead>

        <tbody>
            @foreach($students as $student)
            <tr data-student-id="{{ $student->id }}">
                <td>{{ $student->fullname }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->birth_date }}</td>
                <td>{{ $student->join_date }}</td>
                <td>{{ $student->level }}</td>

                @for($i = 0; $i < 12; $i++)
                    @php
                    $att=$student->attendances->firstWhere('lesson_date', $lesson_dates[$i] ?? null);
                    @endphp
                    <td>
                        <input type="text"
                            maxlength="1"
                            size="1"
                            class="status-input"
                            data-index="{{ $i }}"
                            value="{{ $att->status ?? '' }}">
                    </td>
                    @endfor

                    <td><textarea name="comment">{{ $student->comment }}</textarea></td>
                    <td><input type="number" class="course-price" value="{{ $student->course_price }}" data-field="course_price"></td>
                    <td><input type="number" class="debt1" value="{{ $student->debt1 }}" data-field="debt1"></td>
                    <td><input type="number" class="debt2" value="{{ $student->debt2 }}" data-field="debt2"></td>
                    <td><input type="number" class="paid-sum" value="{{ $student->paid_sum }}" data-field="paid_sum"></td>
            </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="19" style="text-align:right;">
                    Jami to‘langan summa: <span id="total-paid">0</span>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection

@section('scripts')
<script>
    const routes = {
        attendance_save: "{{ route('attendance_save') }}",
        lesson_date_update: "{{ route('lesson_date_update') }}",
        student_update_payment: "{{ route('student_update_payment') }}",
        student_update_comment: "{{ route('student_update_comment') }}"
    };

    const groupId = "{{ is_array($group) ? $group['id'] : $group->id }}";
</script>
<script src="{{ asset('js/group_first_show.js') }}"></script>
@endsection