@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">لوحة التحكم</h1>

        <!-- التنبيهات -->
        @if ($medications->where('expiry_date', '<=', now()->addDays(30))->count() > 0)
            <div class="alert alert-warning" role="alert">
                ⚠️ هناك أدوية ستنتهي صلاحيتها قريبًا!
            </div>
        @endif

        <!-- عرض الأدوية -->
        <div class="row">
            @foreach ($medications as $medication)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $medication->name }}</h5>
                            <p class="card-text">الكمية: {{ $medication->quantity }}</p>
                            <p class="card-text">الصلاحية: {{ $medication->expiry_date }}</p>
                            <p class="card-text">الوصف: {{ $medication->description }}</p>
                            <a href="{{ route('medications.edit', $medication->id) }}" class="btn btn-primary">تعديل</a>
                            <form action="{{ route('medications.destroy', $medication->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- رابط لإرسال طلب للمورد -->
        <a href="{{ route('medications.notify', $medication->id) }}" class="btn btn-warning">إرسال طلب للمورد</a>
    </div>
@endsection