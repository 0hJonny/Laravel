<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Подключаем SweetAlert2 через CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('publications.index') }}">Публикации</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('readers.index') }}">Читатели</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('loans.index') }}">Долги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('copies.index') }}">Экземпляры книг</a>
                    </li>
                </ul>
                <ul class="navbar-nav d-flex align-items-center">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Войти</a>
                    </li>
                    @else
                    <li class="nav-item ">
                        <span class="navbar-text">Привет, {{ Auth::user()->user_name }}!</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Выйти</button>
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Успех',
                text: "{{ session('success') }}"
            });
        </script>
        @endif
        @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Ошибка',
                text: "{{ session('error') }}"
            });
        </script>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer class="mt-4 text-center text-muted fixed-bottom">
    <p>&copy; <?php echo date('Y'); ?> Library</p>
</footer>

</html>