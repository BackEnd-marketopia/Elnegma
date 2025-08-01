<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Search for categories based on the provided search term.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::where('name_arabic', 'LIKE', "%{$search}%")
            ->orWhere('name_english', 'LIKE', "%{$search}%")
            ->orWhere('sort_order', 'LIKE', "%{$search}%")
            ->paginate(10);
        return view('admin.category.index', compact('categories'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $image = Helpers::addImage($request->image, 'category');
        Category::create([
            'name_arabic'  => $request->name_arabic,
            'name_english' => $request->name_english,
            'image'        => $image,
            'sort_order'   => $request->sort_order,
        ]);
        return redirect()->route('admin.categories.index')->with('success', __('message.Category Added Successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $image = $request->image ? $request->image : $category->image;

        if ($request->image) {
            if (File::exists($category->image)) {
                File::delete($category->image);
            }
            $image = Helpers::addImage($request->image, 'category');
        }

        $category->update([
            'name_arabic'  => $request->name_arabic,
            'name_english' => $request->name_english,
            'image'        => $image,
            'sort_order'   => $request->sort_order,
        ]);
        return redirect()->route('admin.categories.index')->with('success', __('message.Category Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        if ($category->vendors()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', __('message.Category Cannot Be Deleted Because It Has Vendors'));
        }
        if (File::exists($category->image))
            File::delete($category->image);

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', __('message.Category Deleted Successfully'));
    }
}
