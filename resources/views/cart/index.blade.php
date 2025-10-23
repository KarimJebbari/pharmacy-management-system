@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">🛒 السلة والأدوية المتاحة</h1>

    <div class="row">
        <!-- 🔍 حقل البحث -->
        <div class="col-md-12 mb-3">
            <form action="{{ route('cart.index') }}" method="GET">
                <input type="text" name="search" class="form-control" placeholder="🔎 ابحث عن دواء..." value="{{ request('search') }}">
            </form>
        </div>

        <!-- 🔹 قائمة الأدوية المتاحة -->
        <div class="col-md-7">
            <h3 class="text-success">🩺 الأدوية المتاحة</h3>
            <div class="row">
                @foreach($medications as $medication)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="دواء">
                            <div class="card-body">
                                <h5 class="card-title text-success">{{ $medication->name }}</h5>
                                <p class="card-text">{{ $medication->description }}</p>
                                <p class="card-text">💰 السعر: {{ $medication->price }} درهم</p>
                                <form action="{{ route('cart.add', $medication->id) }}" method="POST">
                                    @csrf
                                    <input type="number" name="quantity" value="1" min="1" class="form-control mb-2">
                                    <button type="submit" class="btn btn-success w-100">➕ إضافة إلى السلة</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 🔹 محتويات السلة -->
        <div class="col-md-5">
            <h3 class="text-primary">🛍️ محتويات السلة</h3>
            @if(session('cart') && count(session('cart')) > 0)
                <table class="table text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>اسم الدواء</th>
                            <th>الكمية</th>
                            <th>إجمالي السعر</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp
                            <tr>
                                <td>{{ $details['name'] }}</td>
                                <td>{{ $details['quantity'] }}</td>
                                <td>{{ $details['price'] * $details['quantity'] }} درهم</td>
                                <td>
                                    <a href="{{ route('cart.remove', ['id' => $id]) }}" class="btn btn-danger">❌</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h4 class="text-center">💰 الإجمالي: <strong>{{ $total }} درهم</strong></h4>
                <a href="{{ route('cart.checkout') }}" class="btn btn-primary w-100 mt-3">✅ إتمام الشراء</a>
            @else
                <p class="text-center text-muted">السلة فارغة.</p>
            @endif
        </div>
    </div>
</div>
@endsection