<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Если пользователь - консультант, то выводим все чаты с его участием
        if ($user->role == 'consultant') {
            $chats = Chat::with(['user', 'consultant'])
                ->where('consultant_id', $user->id) // Фильтруем чаты по консультанту
                ->get();
        } else {
            // Если пользователь не консультант, выводим только его чаты
            $chats = Chat::with(['user', 'consultant'])
                ->where('user_id', $user->id) // Фильтруем чаты по пользователю
                ->get();
        }
dd($chats);
        return view('chats.index', compact('chats'));
    }

    public function create()
    {
        // Форма для создания нового чата
        return view('chats.create');
    }

    public function store(Request $request)
    {
        // Сохранение нового чата
        $chat = Chat::create([
            'user_id' => $request->user()->id,
            'status' => 'open',
        ]);

        return redirect()->route('chats.index')->with('success', 'Чат успешно создан.');
    }

    public function show($id)
    {
        // Просмотр чата
        $chat = Chat::with('messages')->findOrFail($id);
        return view('chats.show', compact('chat'));
    }

    public function close($id)
    {
        // Закрытие чата
        $chat = Chat::findOrFail($id);
        $chat->update(['status' => 'closed']);

        return redirect()->route('chats.index')->with('success', 'Чат закрыт.');
    }
}
