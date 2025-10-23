<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\NotificationController;

use App\Http\Controllers\ArticleController;



use App\Http\Controllers\InquiryController;

Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
Route::get('/pharmacy/inquiries', [InquiryController::class, 'index'])
    ->name('pharmacy.inquiries')
    ->middleware('auth'); // فقط الصيدلي يمكنه رؤيتها


Route::post('/store-cart', function (Request $request) {
    // تخزين السلة في الـ session
    $cart = json_decode($request->cart_data, true);
    
    if (empty($cart)) {
        return response()->json(['error' => 'لا توجد عناصر في السلة']);
    }

    session(['cart' => $cart]);

    return response()->json(['success' => true]);
});
Route::post('/update-cart', [OrderController::class, 'updateCart'])->name('update.cart');


// Route::get('/purchase', [OrderController::class, 'purchase'])->name('purchase');



// مسارات المصادقة
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// مسارات الأدوية (للمستخدمين المسجلين فقط)
Route::middleware('auth')->group(function () {
    // مسارات الأدوية
    Route::get('/medications', [MedicationController::class, 'index'])->name('medications.index');
    Route::get('/medications/create', [MedicationController::class, 'create'])->name('medications.create');
    Route::post('/medications', [MedicationController::class, 'store'])->name('medications.store');
    Route::delete('/medications/{medication}', [MedicationController::class, 'destroy'])->name('medications.destroy');
    Route::get('/medications/{id}/edit', [MedicationController::class, 'edit'])->name('medications.edit');
    Route::put('/medications/{id}', [MedicationController::class, 'update'])->name('medications.update');
    Route::get('/medications/expiry-alert', [MedicationController::class, 'showExpiryAlert'])->name('medications.expiry-alert');
    Route::get('/medications/{id}/notify', [MedicationController::class, 'notifySupplier'])->name('medications.notify');
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
        Route::post('/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
    });
    // Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    // Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    // قائمة الطلبات للصيدلي
    // Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    // Route::match(['put', 'patch'], '/orders/{order}/validate', [OrderController::class, 'validateOrder'])->name('orders.validate');
    // Route::match(['put', 'patch'], '/orders/{order}/reject', [OrderController::class, 'rejectOrder'])->name('orders.reject');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    
    // تحديث حالة الطلب
    Route::post('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // مسارات السلة
    // Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    // Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'createOrEdit'])->name('articles.create');
Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');


});
Route::resource('articles', ArticleController::class);

Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');



Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout/placeOrder', [CartController::class, 'placeOrder'])->name('cart.placeOrder');

// إرسال طلب الشراء (لا يسجل الطلب مباشرة في قاعدة البيانات)
Route::post('/medications/purchase/order', [OrderController::class, 'store'])->name('medications.purchase.order');

// مسارات الأدوية للمستخدمين بدون تسجيل دخول
Route::get('/medications/purchase', [MedicationController::class, 'purchase'])->name('medications.purchase');
Route::get('/medications/purchase/{id}', [MedicationController::class, 'purchaseShow'])->name('medications.purchase.show');
Route::post('/medications/purchase/{id}/add', [CartController::class, 'addToCart'])->name('medications.purchase.add');
Route::post('/medications/purchase/store', [MedicationController::class, 'purchaseStore'])->name('medications.purchase.store');


Route::post('/purchase', [OrderController::class, 'store'])->name('order.store');
Route::get('/purchase', [MedicationController::class, 'showMedications'])->name('purchase.page');
Route::get('/checkout', function() {
    return view('checkout');
});
Route::get('/medications/purchase', [MedicationController::class, 'purchase'])->name('medications.purchase');
Route::get('/purchase', [MedicationController::class, 'displayMedications'])->name('purchase.page');


Route::get('/medications/out-of-stock', [MedicationController::class, 'outOfStock'])->name('medications.out-of-stock');
Route::post('/medications/notify-supplier/{id}', [MedicationController::class, 'notifySupplier'])->name('medications.notify-supplier');


Route::post('/checkout', [OrderController::class, 'store']);
// الصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
});

// صفحة الـ home
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/pharmacy', [ArticleController::class, 'showPharmacyPage'])->name('pharmacy');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/privacy-policy', function () {
    return view('pages.privacy-policy');
})->name('privacy-policy');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');
// Route::middleware(['auth', 'pharmacist'])->group(function () {
//     Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
//     Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);
//     Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
//     Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount']);
// });
Route::post('/save-cart-to-session', function(Request $request) {
    $request->session()->put('cart', json_decode($request->cart_data, true));
    return response()->json(['success' => true]);
});
Route::post('/prepare-checkout', function(Request $request) {
    $cartData = json_decode($request->cart_data, true);
    
    if (!is_array($cartData)) {
        return redirect()->back()->with('error', 'بيانات السلة غير صالحة');
    }

    // حفظ كامل السلة في الجلسة
    session(['cart' => $cartData]);
    
    return redirect('/checkout');
});
// في routes/web.php


Route::get('/get-counts', [NotificationController::class, 'getCounts'])
    ->middleware('auth'); 
    Route::get('/medications/out-of-stock/{id}', [MedicationController::class, 'showOutOfStock'])
    ->name('medications.out_of_stock');