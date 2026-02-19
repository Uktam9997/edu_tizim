@extends('layout.header_footer')
@section('content')

<link rel="stylesheet" href="{{ asset('css/group_edit.css') }}">
<form action="{{ route('group.group_update', $group->id) }}" method="post">
    @csrf
    <!-- Teacher select -->
    <label for="teacher_id">O'qituvchi tanlang:</label>
    <select name="teacher_id" id="teacher_id" required>
        <option value="" disabled>O'qituvchi tanlang</option>
        @foreach($teachers as $teacher)
        <option value="{{ $teacher->id }}" {{ $group->teacher_id == $teacher->id ? 'selected' : '' }}>
            {{ $teacher->fullname }}
        </option>
        @endforeach
    </select>
    <br><br>

    <!-- Subject select -->
    <label for="subject_id">Fanni tanlang:</label>
    <select name="subject_id" id="subject_id" required>
        <option value="" disabled>Fanni Tanlang</option>
        @foreach($subjects as $subject)
        <option value="{{ $subject->id }}" {{ $group->subject_id == $subject->id ? 'selected' : '' }}>
            {{ $subject->subject_name }}
        </option>
        @endforeach
    </select>
    <br><br>

    <!-- Group Name input -->
    <label for="group_name">Grux nomi:</label>
    <input type="text" name="group_name" id="group_name" required placeholder="Grux nomi" value="{{ $group->group_name }}">
    <br><br>

    <label for="group_active">Status</label>
    <select name="status" id="group_active" required>
        <option value="active" {{ $group->status == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ $group->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        <option value="archived" {{ $group->status == 'archived' ? 'selected' : ''}}>Archived</option>
    </select>
    <br><br>

    <div class="mb-3">
        <label for="closed_at" class="form-label">Arxivlangan sana</label>
        <input type="date" name="closed_at" class="form-control"
            value="{{ $group->closed_at }}" placeholder="Arxivlangan sanani kiriting">
    </div>

    <div class="mb-3">
        <label for="closed_reason" class="form-label">Arxivlash sababi</label>
        <textarea name="closed_reason" class="form-control" placeholder="Arxivlash sababini kiriting">
        {{ $group->closed_reason }}
        </textarea>
    </div>

    <button type="submit">Gruxni yangilash</button>
</form>
@endsection