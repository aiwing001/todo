@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}" />
@endsection


@section('content')

@if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@error('name')
<div class="alert-error">
    {{ $message }}
</div>
@enderror

<div class="category-create container">

    <form class="form" action="/categories" method="POST">
            @csrf
        <div class="form__category-create">
            <input class="form__input form__input--box" type="text" name="name">
            <button class="form__button">作成</button>
        </div>
    </form>
</div>

<div class="container">
    <h2 class="category-title">Category</h2>
    @foreach($categories as $category)
    <div class="category-item">
        <div class="category-box">
            <form action="/categories/{{ $category->id }}" method="POST">
                @csrf
                @method('PATCH')
                <input class="form__input" type="text" name="name" value="{{ $category->name }}">
                <button class="form__button update">更新</button>
            </form>

            <form action="/categories/{{ $category->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="form__button delete">削除</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection

