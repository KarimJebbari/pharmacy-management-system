@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">الأدوية المتاحة للشراء</h1>

    <form action="{{ route('medications.purchase') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="ابحث عن دواء..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">بحث</button>
        </div>
    </form>

    @if($medications->isEmpty())
        <p class="text-center text-muted">لا توجد أدوية متاحة حاليًا.</p>
    @else
        <div class="row">
            <div class="col-md-8">
                <table class="table table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>اسم الدواء</th>
                            <th>الوصف</th>
                            <th>الثمن</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="medications-table">
                        @foreach ($medications as $medication)
                            <tr>
                                <td>{{ $medication->name }}</td>
                                <td>{{ $medication->description }}</td>
                                <td>{{ $medication->price }} ر.س</td>
                                <td>
                                    @if ($medication->quantity > 0)
                                        <button class="btn btn-success btn-sm add-to-cart" 
                                                data-id="{{ $medication->id }}" 
                                                data-name="{{ $medication->name }}" 
                                                data-price="{{ $medication->price }}">
                                            إضافة للسلة
                                        </button>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>غير متاح</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- زر التمرير بين الصفحات -->
                {{ $medications->links() }}
            </div>

            <!-- السلة -->
            <div class="col-md-4">
                <h4>🛒 السلة</h4>
                <p id="cart-empty" class="text-center">السلة فارغة</p>
                <ul id="cart-items" class="list-group mb-3"></ul>
                <p id="cart-count" class="text-center">عدد الأدوية: 0</p>
                <button class="btn btn-primary w-100" id="checkout-btn" data-bs-toggle="modal" data-bs-target="#checkoutModal" disabled>
                    إتمام الشراء
                </button>
            </div>
        </div>
    @endif
</div>

<!-- Modal لإتمام الشراء -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">إتمام الشراء</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('medications.purchase.order') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">الإسم الكامل</label>
                        <input type="text" name="customer_name" class="form-control" id="customer_name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="customer_phone" class="form-label">رقم الهاتف</label>
                        <input type="text" name="customer_phone" class="form-control" id="customer_phone" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">العنوان</label>
                        <input type="text" name="address" class="form-control" id="address" required>
                    </div>

                    <div class="mb-3">
                        <label for="prescription" class="form-label">تحميل الوصفة الطبية</label>
                        <input type="file" name="prescription" class="form-control" id="prescription" required>
                    </div>

                    <input type="hidden" name="cart" id="cart-data">

                    <button type="submit" class="btn btn-primary">إرسال الطلب</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    function updateCartUI() {
        let cartItemsContainer = document.getElementById("cart-items");
        let cartEmptyMessage = document.getElementById("cart-empty");
        let checkoutBtn = document.getElementById("checkout-btn");
        let cartCount = document.getElementById("cart-count");

        cartItemsContainer.innerHTML = "";
        
        if (cart.length === 0) {
            cartEmptyMessage.style.display = "block";
            checkoutBtn.disabled = true;
            cartCount.innerText = "عدد الأدوية: 0";
        } else {
            cartEmptyMessage.style.display = "none";
            checkoutBtn.disabled = false;

            cart.forEach(item => {
                let li = document.createElement("li");
                li.className = "list-group-item d-flex justify-content-between align-items-center";
                li.innerHTML = `${item.name} - ${item.price} ر.س 
                    <button class="btn btn-danger btn-sm remove-from-cart" data-id="${item.id}">❌</button>`;
                cartItemsContainer.appendChild(li);
            });

            cartCount.innerText = `عدد الأدوية: ${cart.length}`;
        }
    }

    document.getElementById("medications-table").addEventListener("click", function (event) {
        if (event.target.classList.contains("add-to-cart")) {
            let id = event.target.getAttribute("data-id");
            let name = event.target.getAttribute("data-name");
            let price = event.target.getAttribute("data-price");

            cart.push({ id, name, price });
            localStorage.setItem("cart", JSON.stringify(cart));
            updateCartUI();
        }
    });

    document.getElementById("cart-items").addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-from-cart")) {
            let id = event.target.getAttribute("data-id");
            cart = cart.filter(item => item.id !== id);
            localStorage.setItem("cart", JSON.stringify(cart));
            updateCartUI();
        }
    });

    document.getElementById("checkoutModal").addEventListener("show.bs.modal", function () {
        document.getElementById("cart-data").value = JSON.stringify(cart);
    });

    updateCartUI();
});
</script>
@endsection