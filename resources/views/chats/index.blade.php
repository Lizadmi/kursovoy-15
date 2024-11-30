@extends('layouts.app')

@section('title', 'Список чатов')

@section('content')
    <h1>Список чатов</h1>
    <a href="{{ route('chats.create') }}" class="btn btn-success mb-3">Создать чат</a>
    @if (auth()->user()->role == 'consultant')
        <h5>Вы консультант, здесь ваши чаты:</h5>
        @if ($chats->isEmpty())
            <p>Чатов пока нет.</p>
        @else
            <div class="list-group">
                @foreach ($chats as $chat)
                    <a href="{{ route('chats.show', $chat->id) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between">
                            <span>Чат с пользователем {{ $chat->user->id }} - {{ $chat->user->name }}</span>
                            <small class="text-muted">Создан: {{ $chat->created_at->format('d.m.Y H:i') }}</small>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    @else
        <h5>Ваши чаты:</h5>
        @if ($chats->isEmpty())
            <p>Чатов пока нет.</p>
        @else
            <div class="list-group">
                @foreach ($chats as $chat)
                    <a href="{{ route('chats.show', $chat->id) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between">
                            <span>Чат с консультантом </span>
                            <small class="text-muted">Создан: {{ $chat->created_at->format('d.m.Y H:i') }}</small>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    @endif
@endsection
