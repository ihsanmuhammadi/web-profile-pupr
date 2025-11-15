<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->service->getAll();
        return view('dummyviews.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dummyviews.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('categories.index')->with('success', 'categories created successfully.');
    }

    public function show(Category $category)
    {
        return view('dummyviews.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('dummyviews.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->service->update($category, $request->validated());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $this->service->delete($category);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
