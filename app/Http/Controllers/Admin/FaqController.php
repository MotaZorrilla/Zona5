<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::ordered()->paginate(15);
        $categories = Faq::getCategories();

        return view('admin.faqs.index', compact('faqs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Faq::getCategories();
        return view('admin.faqs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.faqs.create')
                           ->withErrors($validator)
                           ->withInput();
        }

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'category' => $request->category,
            'is_active' => $request->boolean('is_active', true),
            'order' => $request->integer('order', 0),
        ]);

        return redirect()->route('admin.faqs.index')
                        ->with('success', 'Pregunta frecuente creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        return view('admin.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        $categories = Faq::getCategories();
        return view('admin.faqs.edit', compact('faq', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.faqs.edit', $faq)
                           ->withErrors($validator)
                           ->withInput();
        }

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'category' => $request->category,
            'is_active' => $request->boolean('is_active', true),
            'order' => $request->integer('order', 0),
        ]);

        return redirect()->route('admin.faqs.index')
                        ->with('success', 'Pregunta frecuente actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
                        ->with('success', 'Pregunta frecuente eliminada correctamente');
    }

    /**
     * Toggle active status of the specified FAQ.
     */
    public function toggle(Faq $faq)
    {
        $faq->update([
            'is_active' => !$faq->is_active
        ]);

        return redirect()->route('admin.faqs.index')
                        ->with('success', 'Estado de la pregunta frecuente actualizado correctamente');
    }
}