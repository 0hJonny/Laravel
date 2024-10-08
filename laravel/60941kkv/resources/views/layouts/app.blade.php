<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library')</title>
    <!-- Подключаем стили Bootstrap (можно использовать другие стили по желанию) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
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
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Подключаем скрипты Bootstrap (необязательно, если не используете интерактивные элементы) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
    <footer class="mt-4 text-center text-muted fixed-bottom">
        <p>&copy; <?php echo date('Y'); ?> Library</p>
    </footer>
</html>
