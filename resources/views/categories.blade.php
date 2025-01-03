@extends('layouts/header')
@section('title', 'Категории товаров')
@section('content')
        @foreach($categories as $category)
            <div class="panel">
                <a href="{{ route('category', ['category' => $category->code]) }}">
                    <img src="">
                    <h2>{{ $category->name }}</h2>
                </a>
                <p>
                   {{ $category->description }}
                </p>
            </div>
        @endforeach
@endsection
