@extends('layouts.app')

@section('content')
    <h1>{{ isset($faq) ? 'Редактировать вопрос' : 'Добавить вопрос' }}</h1>
    <form action="{{ isset($faq) ? route('faqs.update', $faq->id) : route('faqs.store') }}" method="POST">
        @csrf
        @if (isset($faq))
            @method('PUT')
        @endif
        <div>
            <label for="question">Вопрос</label>
            <input type="text" name="question" value="{{ $faq->question ?? '' }}" required>
        </div>
        <div>
            <label for="answer">Ответ</label>
            <textarea name="answer" required>{{ $faq->answer ?? '' }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            {{ isset($faq) ? 'Обновить' : 'Сохранить' }}
        </button>
    </form>
@endsection
