@extends('layouts.app')

@section('content')
    <h1>Создать чат</h1>
    <form action="{{ route('chats.store') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
