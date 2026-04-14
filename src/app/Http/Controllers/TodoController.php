<?php

namespace App\Http\Controllers;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('category')->get();
        $categories = Category::all();
        return view('index', compact('todos', 'categories'));
    }

    public function store(TodoRequest $request)
    {
        Todo::create([
            'content' => $request->text,
            'category_id' => $request->category_id,
            ]);

        return redirect('/')->with('success', 'Todoを作成しました');
    }

    public function update(TodoRequest $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update(['content' => $request->text]);
        return redirect('/')->with('success', 'Todoを更新しました');;
    }

    public function destroy($id)
    {
        Todo::find($id)->delete();
        return redirect("/")->with('success', 'Todoを削除しました');;
    }

    public function search(Request $request)
    {
        $todos = Todo::with('category')
            ->CategorySearch($request->category_id)
            ->KeywordSearch($request->keyword)
            ->get();

        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }

}

