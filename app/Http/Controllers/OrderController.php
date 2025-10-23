<?php
// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Order;
// use App\Models\Medication;

// class OrderController extends Controller
// {
//     // عرض جميع الطلبات
//     public function index()
//     {
//         $orders = Order::all();
//         return view('orders.index', compact('orders'));
//     }

//     // الموافقة على الطلب
//     public function validateOrder($id)
//     {
//         $order = Order::findOrFail($id);
//         $order->status = 'validé';
//         $order->save();

//         return redirect()->route('orders.index')->with('success', '✅ تمت الموافقة على الطلب بنجاح');
//     }

//     // رفض الطلب
//     public function rejectOrder($id)
//     {
//         $order = Order::findOrFail($id);
//         $order->status = 'refusé';
//         $order->save();

//         return redirect()->route('orders.index')->with('error', '❌ تم رفض الطلب');
//     }

//     // تخزين الطلب
//     public function store(Request $request)
// {
//     // التحقق من المدخلات
//     $request->validate([
//         'customer_name' => 'required|string|max:255',
//         'customer_phone' => 'required|string|max:20',
//         'address' => 'required|string',
//         'prescription' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
//         'cart_data' => 'required', // ✅ إضافة التحقق من السلة
//     ]);

//     // رفع الوصفة الطبية
//     $filePath = $request->hasFile('prescription') 
//                 ? $request->file('prescription')->store('prescriptions', 'public') 
//                 : null;

//     // تحويل بيانات السلة من JSON إلى Array
//     $cart = json_decode($request->cart_data, true);

//     // إدخال الطلبات في قاعدة البيانات
//     foreach ($cart as $id => $details) {
//         Order::create([
//             'customer_name' => $request->customer_name,
//             'customer_phone' => $request->customer_phone,
//             'address' => $request->address,
//             'medication_id' => $id,
//             'quantity' => $details['quantity'],
//             'total_price' => $details['price'] * $details['quantity'],
//             'prescription' => $filePath,
//             'status' => 'en attente',
//         ]);
//     }

//     // تفريغ السلة بعد الطلب
//     session()->forget('cart');

//     return redirect()->route('medications.purchase')->with('success', '✅ تم إرسال الطلب بنجاح.');
// }
//     public function checkout()
//     {
//     $medications = Medication::all(); // ✅ جلب جميع الأدوية
//     return view('cart.checkout', compact('medications')); // ✅ إرسالها إلى العرض
// }

// }



// namespace App\Http\Controllers;

// use App\Models\Cmd;
// use Illuminate\Http\Request;

// class OrderController extends Controller
// {
//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'customer_name' => 'required|string|max:255',
//             'address' => 'required|string',
//             'phone' => 'required|string|max:20',
//             'prescription' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//             'medications' => 'required|array',
//             'total_price' => 'required|numeric',
//         ]);

//         // حفظ صورة الوصفة الطبية
//         $imagePath = $request->file('prescription')->store('prescriptions', 'public');

//         // إنشاء الطلب
//         Cmd::create([
//             'customer_name' => $validated['customer_name'],
//             'address' => $validated['address'],
//             'phone' => $validated['phone'],
//             'prescription' => $imagePath,
//             'medications' => json_encode($validated['medications']),
//             'total_price' => $validated['total_price'],
//             'status' => 'En attente',
//         ]);

//         return redirect()->back()->with('success', 'تم تسجيل طلبك بنجاح!');
//     }
// }

namespace App\Http\Controllers;

use App\Models\Cmd;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 
use App\Models\Medication;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = json_decode($request->input('cart_data'), true);
    
    
        if (empty($cart)) {
            return redirect()->back()->with('error', 'panier et vide');
        }
    
        $imagePath = $request->file('prescription')->store('prescriptions', 'public');
    
 
        Cmd::create([
            'customer_name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'prescription' => $imagePath,
            'medications' => $request->input('cart_data'), 
            'total_price' => $this->calculateTotalPrice($cart), 
        ]);
    
        return redirect('/')->with('success', '✅ Votre demande a été soumise avec succès !');
    }
    

    private function calculateTotalPrice($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $orders = Cmd::when($search, function($query, $search) {
            return $query->where('customer_name', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%") 
                         ->orWhere('status', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->paginate(8); 
    
        return view('orders.index', compact('orders'));
    }

  
    public function updateStatus(Request $request, $id)
    {
        $order = Cmd::findOrFail($id);
        $newStatus = $request->input('status');
    
       
        $order->update(['status' => $newStatus]);
    
       
        if ($newStatus === 'Validé') {
            $medications = json_decode($order->medications, true); 
            
            foreach ($medications as $medication) {
                $product = Medication::where('name', $medication['name'])->first(); 
                
                if ($product) {
                    $product->quantity -= $medication['quantity']; 
                    $product->save(); 
                }
            }
        }
    
        return redirect()->back()->with('success', 'Le statut de la commande a été mis à jour avec succès.');
    }
    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('purchase')->with('error', 'panier et vide');
        }

    }    
    public function updateCart(Request $request)
    {

        $cart = $request->input('cart');
        if (is_array($cart)) {
            session(['cart' => $cart]); 
            return response()->json(['message' => 'Le panier a été mis à jour.']);
        }
        return response()->json(['message' => 'Le panier n’est pas adapté.'], 400);
    }
    

}