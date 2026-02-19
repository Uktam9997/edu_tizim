<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edu Tizim</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
</head>

<body>
    <header>
        <div>
            <a href="{{ route('schedule.show_schedule') }}">
                <img src="{{ asset('images/logo_edu.jpg') }}" alt="Logo">
            </a>
        </div>

        <nav>
            <a href="{{ route('teacher.teacher_show') }}">O'qituvchilar</a>
            <a href="{{ route('subject.subject_show') }}">Fanlar</a>
            <a href="{{ route('group.group_show') }}">Guruhlar</a>
            <a href="{{ route('student.student_show') }}">O'quvchilar</a>
            <a href="{{ route('schedule.schedule_create') }}">Jadval qo'shish</a>
        </nav>

        <div class="search-box" style="position: relative; width: 300px;">
            <input type="text" id="studentSearch" placeholder="O‘quvchini qidiring...">
            <div id="searchToast" class="search-results"></div>
        </div>

        <div style="display: flex; align-items: center; gap: 12px;">
            <span><strong>Admin</strong></span>
            <a href="#" style="background:#ef4444; color:white; padding:5px 10px; border-radius:6px;">Chiqish</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <a href="https://www.instagram.com/uktam_6582?igsh=MTRlZjBrcnJnYWU5cg%3D%3D&utm_source=qr">
            &copy; {{ date('Y') }} Xazratqulov.U
        </a>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/search.js') }}?v={{ time() }}"></script>
    @yield('scripts')
</body>
</html>
