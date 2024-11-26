<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home()
    {
        // Определяем главную страницу в зависимости от роли пользователя
        if (auth()->check()) {
            if (auth()->user()->hasRole('consultant')) {
                return redirect()->route('faqs.index');
            }
            return redirect()->route('chats.index');
        }
        return view('welcome');
    }
     // Показ формы регистрации
     public function showRegisterForm()
     {
         return view('auth.register');
     }
 
     // Регистрация
     public function register(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:8|confirmed',
         ]);
 
         if ($validator->fails()) {
             return back()->withErrors($validator)->withInput();
         }
 
         $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
             'role' => 'user'
         ]);
 
         // Вход после регистрации
         Auth::login($user);
 
         return redirect()->route('home')->with('message', 'Регистрация прошла успешно');
     }
 
     // Показ формы авторизации
     public function showLoginForm()
     {
         return view('auth.login');
     }
 
     // Авторизация
     public function login(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'email' => 'required|string|email',
             'password' => 'required|string',
         ]);
 
         if ($validator->fails()) {
             return back()->withErrors($validator)->withInput();
         }
 
         if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
             return redirect()->route('home')->with('message', 'Авторизация успешна');
         }
 
         return back()->withErrors(['message' => 'Неверные данные для входа']);
     }
 
     // Выход
     public function logout(Request $request)
     {
         Auth::logout();
 
         $request->session()->invalidate();
         $request->session()->regenerateToken();
 
         return redirect()->route('login')->with('message', 'Выход выполнен успешно');
     }
}
