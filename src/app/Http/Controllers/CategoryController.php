<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
        ]);
        return redirect('/categories')->with('success', 'カテゴリを作成しました');;
    }

    public function update(CategoryRequest $request, $id)
    {
        $category =Category::find($id);
        $category->update([
            'name' => $request->name,
        ]);
        return redirect('/categories')->with('success', 'カテゴリを更新しました');;
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect('/categories')->with('success', 'カテゴリを削除しました');;
    }
}

