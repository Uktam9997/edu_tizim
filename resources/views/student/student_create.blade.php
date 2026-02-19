@extends('layout.header_footer')
@section('content')

<link rel="stylesheet" href="{{ asset('css/student_create.css') }}">
<form action="{{route('student.student_store')}}" method="post">
    @csrf
    <label for="group_id">Guruxni Tanlang:</label>
    <select name="group_id" id="group_id" required>
        <option value="" disabled selected>Guruxni Tanlang</option>
        @foreach($groups as $group)
        <option value="{{ $group->id }}">{{ $group->group_name }}</option>
        @endforeach
    </select>
    <br><br>
    <label for="fullname">To'liq ismi sharifi:</label>
    <input type="text" id="fullname" name="fullname" required><br><br>
    Tel:
    <input type="text" name="phone" id="phone" placeholder="Phone number"><br><br>
    Tugilgan sana:
    <input type="date" name="birth_date" id="birth_date"><br><br>
    Qabul qilingan sana:
    <input type="date" name="join_date" id="join_date" required><br><br>
    Daraja:
    <input type="text" name="level" id="level" placeholder="Daraja (Shart emas)"><br><br>
    Kurs narxi:
    <input type="number" name="course_price" id="price" placeholder="Kurs narxi" required><br><br>
    To'langan narxi:
    <input type="number" name="paid_sum" id="paid_amount" placeholder="To'langan narxi (3 Dars tekin)"><br><br>
    Izox:
    <input type="text" name="comment" id="comment" placeholder="Izox (Shart emas)"><br><br>

    <button type="submit">Create Student</button>
</form>
@endsection