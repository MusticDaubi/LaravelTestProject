@extends('layouts/header')
@section('title', $category->name)
@section('content')
        <h1>
            {{ $category->name }}
        </h1>
        <p>
            Количетсво товаров: {{ $category->products->count() }}
        </p>
        <p>
            {{ $category->description }}
        </p>
        <div class="row">
            @foreach ($category->products as $product)
                @include('CardProduct', compact('product'))
            @endforeach
        </div>

@endsection

