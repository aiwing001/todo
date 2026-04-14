@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection


@section('content')

@if (session('success'))
<div class="alert-success">
    {{ session('success') }}
</div>
@endif

@error('text')
<div class="alert-error">
    {{ $message }}
</div>
@enderror

@error('category_id')
<div class="alert-error">
    {{ $message }}
</div>
@enderror

<div class="todo-create container">
    <h2 class="todo-create__title">新規作成</h2>
    <form class="form" action="/todos" method="POST">
            @csrf
        <div class="form__todo-create">
            <input class="form__input form__input--box" type="text" name="text" value="{{ old('text') }}">
            <select class="form__select" name="category_id">
                <option value="">カテゴリを選択</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
                @endforeach
            </select>
            <button class="form__button ">作成</button>
        </div>
    </form>
</div>

<div class="todo-search container">
    <h2>Todo検索</h2>
    <form class="form" action="{{ route('todos.search') }}" method="GET">
        <div class="form__todo-create">
            <input class="form__input form__input--box" type="text" name="keyword" value="{{ request('keyword') }}">
            <select class="form__select" name="category_id">
                <option value="">
                    カテゴリを選択
                </option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
            </select>
            <button class="form__button ">検索</button>
        </div>
    </form>
</div>

<div class="container">
    <div class="todo-header">
        <span class="header-todo">Todo</span>
        <span class="header-category">Category</span>
    </div>
    @foreach($todos as $todo)
    <div class="todo-item">
        <div class="todo-box">
            
            <form action="/todos/{{ $todo->id }}" method="POST">
                @csrf
                @method('PATCH')
                <input class="form__input" type="text" name="text" value="{{ $todo->content }}">
                <select class="select-category" name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $todo->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                <button class="form__button update">更新</button>
            </form>
            <form action="/todos/{{ $todo->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="form__button delete">削除</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

@endsection

