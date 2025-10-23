<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
 
    public function showLoginForm()
{
    return view('auth.login');
}

public function login(Request $request)
{
   
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ], [
        'email.required' => 'يرجى إدخال البريد الإلكتروني',
        'email.email' => 'يرجى إدخال بريد إلكتروني صالح',
        'password.required' => 'يرجى إدخال كلمة المرور',
        'password.min' => 'يجب أن تحتوي كلمة المرور على 6 أحرف على الأقل',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
 
        if (Auth::user()->is_pharmacist) {
            return redirect()->route('medications.index');
        } else {
            return redirect()->route('medications.index'); 
        }
    }

    return redirect()->back()->withErrors(['email' => 'Les identifiants de connexion sont incorrects.'])->withInput();
}
}