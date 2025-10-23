<!-- resources/views/medications/purchase_show.blade.php -->
<!-- @extends('layouts.app') -->

<!-- @section('content') -->
    <!-- <h1>{{ $medication->name }}</h1>
    <p>{{ $medication->description }}</p>

    <form action="{{ route('medications.purchase.store', $medication->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="quantity">الكمية</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">شراء</button>
    </form> -->
<!-- @endsection -->

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pharmacie Aya Sofia</title>
    
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* الشريط العلوي بتصميم جذاب */
        .navbar-custom {
            background: linear-gradient(45deg, #28a745, #218838);
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .navbar-custom .nav-link {
            color: white !important;
            font-weight: bold;
            transition: color 0.3s;
        }
        .navbar-custom .nav-link:hover {
            color: #c8f7c5 !important;
        }
        .navbar-custom .navbar-brand {
            font-weight: bold;
            color: #fff !important;
            font-size: 1.5rem;
        }
        .navbar-toggler {
            background-color: #fff;
            border: none;
        }

        /* تصميم جذاب للوحة التحكم مع زر إخفاء */
        #sidebar {
            width: 260px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(45deg, #343a40, #23272b);
            color: white;
            transition: all 0.3s;
            box-shadow: 4px 0px 8px rgba(0, 0, 0, 0.2);
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        #sidebar h4 {
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 1.2rem;
        }
        #sidebar .nav-link {
            padding: 12px;
            margin: 5px;
            border-radius: 8px;
            font-weight: bold;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }
        #sidebar .nav-link i {
            margin-right: 10px;
        }
        #sidebar .nav-link:hover {
            background-color: #28a745 !important;
            color: white !important;
            transform: scale(1.05);
        }
        #main-content {
            margin-left: 260px;
            transition: all 0.3s;
        }
        .sidebar-hidden #sidebar {
            width: 0;
            overflow: hidden;
        }
        .sidebar-hidden #main-content {
            margin-left: 0;
        }
        .toggle-sidebar-btn {
            position: absolute;
            top: 20px;
            left: 270px;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .toggle-sidebar-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('medications.purchase') }}">Pharmacie Aya Sofia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if(auth()->check()) 
                        <li class="nav-item"><a class="nav-link" href="{{ route('medications.index') }}">إدارة الأدوية</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">تسجيل الدخول</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('medications.purchase') }}">شراء الأدوية</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <button class="toggle-sidebar-btn" onclick="toggleSidebar()">☰</button>
    <div class="d-flex" id="page-container">
        @if(!Request::is('purchase') && !Request::is('checkout')) 
        <div id="sidebar" class="p-3">
            <h4>📋 لوحة التحكم</h4>
            <ul class="nav flex-column flex-grow-1">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('medications.index') }}"><i class="fas fa-pills"></i> لائحة الأدوية</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('orders.index') }}"><i class="fas fa-list"></i> الطلبات</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('medications.create') }}"><i class="fas fa-plus-circle"></i> إضافة دواء جديد</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('medications.expiry-alert') }}"><i class="fas fa-exclamation-triangle"></i> تنبيهات الصلاحية</a></li>
            </ul>
            <form action="{{ route('logout') }}" method="POST" class="mt-auto p-3">
                @csrf
                <button type="submit" class="btn btn-danger w-100">🚪 تسجيل الخروج</button>
            </form>
        </div>
        @endif

        <div id="main-content" class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById("page-container").classList.toggle("sidebar-hidden");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
