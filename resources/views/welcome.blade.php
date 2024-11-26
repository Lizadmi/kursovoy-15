@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="jumbotron text-center">
        <h1 class="display-4">Добро пожаловать на онлайн-консультацию!</h1>
        <p class="lead">Зарегистрируйтесь, чтобы начать общаться в чате с консультантами или отвечать на часто задаваемые вопросы в качестве администратора.</p>
        <hr class="my-4">
        <a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Регистрация</a>
        <a class="btn btn-secondary btn-lg" href="{{ route('login') }}" role="button">Вход</a>
    </div>
@endsection
