<!-- @extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-body text-center p-5">
            <div class="mb-4">
                <i class="fas fa-check-circle fa-5x text-success"></i>
            </div>
            <h2 class="mb-3">شكراً لك!</h2>
            <p class="lead">تم استلام طلبك بنجاح وسيتم معالجته قريباً</p>
            
            <div class="order-details mt-4 p-4 bg-light rounded-3">
                <h4>معلومات الطلب</h4>
                <p><strong>رقم الطلب:</strong> #{{ $order->id }}</p>
                <p><strong>حالة الطلب:</strong> <span class="badge bg-info">{{ $order->status }}</span></p>
                <p><strong>المجموع:</strong> {{ number_format($order->total_price, 2) }} درهم</p>
            </div>
            
            <a href="{{ route('purchase.page') }}" class="btn btn-primary mt-4 rounded-pill px-4">
                العودة إلى المتجر
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // تفريغ السلة المحلية عند زيارة صفحة التأكيد
        localStorage.removeItem('pharmacy_cart');
    });
</script>
@endsection -->