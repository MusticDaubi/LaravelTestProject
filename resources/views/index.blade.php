@extends('layouts/header')
@section('title', 'Главная страница')
@section('content')
        <h1>Все товары</h1>

        <div class="row">
            @foreach($products as $product)
                @include('CardProduct', compact('product'))
            @endforeach
        </div>
@endsection
