@extends('layouts.app')

@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- ✅ عنوان المقالة -->
            <h1 class="fw-bold text-primary text-center mb-4">{{ $article->title }}</h1>

            <!-- ✅ صورة المقالة (إن وجدت) -->
            @if($article->image)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid rounded-4 shadow-sm" alt="صورة المقال" style="max-height: 400px;">
                </div>
            @endif

            <!-- ✅ محتوى المقالة -->
            <div class="card shadow-lg p-4 rounded-4">
                <p class="fs-5 text-muted">{!! nl2br(e($article->content)) !!}</p>
            </div>

            <!-- ✅ زر العودة -->
            <div class="text-center mt-4">
                <a href="{{ route('pharmacy') }}" class="btn btn-outline-primary btn-lg">🔙 Retour aux articles</a>
            </div>

        </div>
    </div>
</div>
<style>
    h1 {
    font-family: 'Cairo', sans-serif;
    font-size: 2.2rem;
    font-weight: bold;
    color: #007bff;
}

.card {
    background-color:rgb(249, 249, 249);
    border-radius: 15px;
    padding: 20px;
    line-height: 1.8;
    font-size: 1.2rem;
    color: #333;
}

.img-fluid {
    border-radius: 15px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}

.btn-outline-primary {
    font-size: 1.1rem;
    padding: 10px 20px;
    border-radius: 30px;
}
#sidebar {
            display: none; /* إخفاء الشريط الجانبي */
        }
        #main-content {
            margin-left: 0;
            width: 100%;
        }
</style>
@endsection
