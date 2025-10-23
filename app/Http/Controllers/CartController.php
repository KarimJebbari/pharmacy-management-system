<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medication;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
   
    public function index(Request $request)
    {
        $search = $request->query('search');
        $medications = Medication::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%$search%");
        })->get();

        $cart = Session::get('cart', []);
        return view('cart.index', compact('medications', 'cart'));
    }

   
    public function addToCart(Request $request, $id)
    {
        $medication = Medication::findOrFail($id);

        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity;
        } else {
            $cart[$id] = [
                'name' => $medication->name,
                'price' => $medication->price,
                'quantity' => $request->quantity
            ];
        }

        Session::put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'تمت إضافة الدواء إلى السلة!');
    }

    // إزالة دواء من السلة
    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'تمت إزالة الدواء من السلة!');
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);
        return view('cart.checkout', compact('cart'));
    }


    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'address' => 'required|string',
            'prescription' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        $prescriptionPath = null;
        if ($request->hasFile('prescription')) {
            $prescriptionPath = $request->file('prescription')->store('prescriptions', 'public');
        }

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة، لا يمكن إتمام الطلب.');
        }

        foreach ($cart as $id => $details) {
            Order::create([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'address' => $request->address,
                'prescription_image' => $prescriptionPath,
                'quantity' => $details['quantity'],
                'total_price' => $details['price'] * $details['quantity'],
                'user_id' => auth()->id(),
                'status' => 'قيد المعالجة'
            ]);
        }

        Session::forget('cart');

        return redirect()->route('cart.index')->with('success', 'تم إرسال الطلب بنجاح!');
    }
}
