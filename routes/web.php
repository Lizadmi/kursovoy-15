<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\UserController;

// Главная страница
Route::get('/', [UserController::class, 'home'])->name('home');

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Защищенные маршруты
// Route::middleware(['auth'])->group(function () {
    // Чаты
    Route::get('chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('chats/create', [ChatController::class, 'create'])->name('chats.create');
    Route::post('chats', [ChatController::class, 'store'])->name('chats.store');
    Route::get('chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
    Route::patch('chats/{chat}/close', [ChatController::class, 'close'])->name('chats.close');

    // Сообщения
    Route::post('messages/{chat}', [MessageController::class, 'store'])->name('messages.store');

    // Только для администраторов
    // Route::middleware(['role:consultant'])->group(function () {
        Route::get('faqs', [FaqController::class, 'index'])->name('faqs.index');
        Route::get('faqs/create', [FaqController::class, 'create'])->name('faqs.create');
        Route::post('faqs', [FaqController::class, 'store'])->name('faqs.store');
        Route::get('faqs/{faq}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
        Route::put('faqs/{faq}', [FaqController::class, 'update'])->name('faqs.update');
        Route::delete('faqs/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');
    // });
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
