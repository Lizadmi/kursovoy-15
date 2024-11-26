<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, Chat $chat)
    {
        $request->validate([
            'content' => 'nullable|string',
            'photo' => 'nullable|image|max:2048', // Проверка на загружаемое фото
        ]);
    
        $photoPath = null;
    
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('messages/photos', 'public');
        }
    
        $chat->messages()->create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'photo' => $photoPath,
        ]);
    
        return redirect()->route('chats.show', $chat->id)
                         ->with('success', 'Сообщение отправлено!');
    }
    
}
