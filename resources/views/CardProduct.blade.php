<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="" alt="{{$product->name}}">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->price }}</p>
            <p>
                <form action="{{ route('basketAdd', $product->id)}}" method="POST" >
                @csrf
                    <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                    <a href="{{ route('product', [$product->category->code, $product->code]) }}" class="btn btn-default" role="button">Подробнее</a>
                </form>
            </p>
        </div>
    </div>
</div>
