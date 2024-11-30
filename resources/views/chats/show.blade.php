@extends('layouts.app')

@section('title', 'Чат')

@section('content')
    <h1>Чат с {{ $chat->consultant->name ?? 'консультантом' }}</h1>
    <div class="card">
        <div class="card-header">Сообщения</div>
        <div class="card-body">
            @if ($chat->messages->isEmpty())
                <p>Сообщений пока нет.</p>
            @else
                <ul class="list-group">
                    @foreach ($chat->messages as $message)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $message->user->name }}</strong>
                                <small class="text-muted">{{ $message->created_at->format('d.m.Y H:i') }}</small>
                            </div>
                            <p>{{ $message->content }}</p>
                            @if ($message->photo)
                                <img src="{{ asset('storage/' . $message->photo) }}" alt="Фото сообщения" class="img-fluid mt-2">
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <form action="{{ route('messages.store', $chat->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf
        <div class="mb-3">
            <textarea required name="content" class="form-control" rows="3" placeholder="Введите сообщение..."></textarea>
        </div>
        <div class="mb-3">
            <input type="file" name="photo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
