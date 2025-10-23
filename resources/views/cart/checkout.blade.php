<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إتمام الشراء</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">✅ إتمام الشراء</h1>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-success">🛍️ محتويات السلة</h3>
                <table class="table text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>اسم الدواء</th>
                            <th>الكمية</th>
                            <th>إجمالي السعر</th>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h4 class="text-center">💰 الإجمالي: <strong>{{ $total }} درهم</strong></h4>
            </div>

            <div class="col-md-6">
                <h3 class="text-primary">📄 بياناتك لإتمام الطلب</h3>
                <form action="{{ route('cart.placeOrder') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="customer_name" placeholder="اسم العميل" required class="form-control mb-2">
                    <input type="text" name="customer_phone" placeholder="رقم الهاتف" required class="form-control mb-2">
                    <textarea name="address" placeholder="العنوان" required class="form-control mb-2"></textarea>
                    <label>📎 تحميل وصفة طبية (اختياري):</label>
                    <input type="file" name="prescription" accept="image/*,application/pdf" class="form-control mb-2">

                    <!-- ✅ تمرير بيانات السلة كـ JSON -->
                    <input type="hidden" name="cart_data" value="{{ json_encode(session('cart')) }}">

                    <button type="submit" class="btn btn-primary w-100">إتمام الطلب</button>
                </form>
            </div>
        </div>
    @else
        <p class="text-center text-muted">السلة فارغة، لا يمكن إتمام الطلب.</p>
    @endif
</div>
</body>
</html>