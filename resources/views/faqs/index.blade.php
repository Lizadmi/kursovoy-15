@extends('layouts.app')

@section('title', 'Manage FAQs')

@section('content')
    <h1>FAQ Management</h1>
    <a href="{{ route('faqs.create') }}" class="btn btn-primary mb-3">Add New FAQ</a>
    @if ($faqs->isEmpty())
        <p>No FAQs available.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $faq)
                    <tr>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td>
                            <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
