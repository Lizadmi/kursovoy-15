<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        // Список всех вопросов
        $faqs = Faq::all();
        return view('faqs.index', compact('faqs'));
    }

    public function create()
    {
        // Форма для добавления вопроса
        return view('faqs.create');
    }

    public function store(Request $request)
    {
        // Сохранение нового вопроса
        FAQ::create($request->only(['question', 'answer']));
        return redirect()->route('faqs.index')->with('success', 'Вопрос добавлен.');
    }

    public function edit($id)
    {
        // Форма для редактирования вопроса
        $faq = Faq::findOrFail($id);
        return view('faqs.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        // Обновление вопроса
        $faq = Faq::findOrFail($id);
        $faq->update($request->only(['question', 'answer']));
        return redirect()->route('faqs.index')->with('success', 'Вопрос обновлён.');
    }

    public function destroy($id)
    {
        // Удаление вопроса
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('faqs.index')->with('success', 'Вопрос удалён.');
    }
}
