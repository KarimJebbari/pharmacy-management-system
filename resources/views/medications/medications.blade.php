<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الأدوية - صيدلية آية صوفيا</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #28a745;">
        <div class="container">
            <a class="navbar-brand text-white" href="#">صيدلية آية صوفيا</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('/') }}">الصفحة الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('/medications') }}">الأدوية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">خدمة العملاء</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <form action="{{ url('/medications') }}" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="ابحث عن الدواء" value="{{ request('search') }}">
                <button class="btn btn-success" type="submit">بحث</button>
            </div>
        </form>
    </div>

    <div class="container mt-4">
        <div class="row">
            @foreach($medicines as $medicine)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="دواء">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #28a745;">{{ $medicine->name }}</h5>
                            <p class="card-text">{{ $medicine->description }}</p>
                            <p class="card-text">السعر: {{ $medicine->price }} درهم</p>
                            <a href="#" class="btn btn-success">شراء الآن</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $medicines->links() }}
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>