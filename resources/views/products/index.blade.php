@extends('index')

@section('title', 'Страница продуктов')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">Товар успешно добавлен!</div>
    @endif
    @if(session()->has('update'))
        <div class="alert alert-success">Товар успешно отредактирован!</div>
    @endif
    @if(session()->has('delete'))
        <div class="alert alert-success">Товар успешно удален!</div>
    @endif
    <div class="container mt-3">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 p-3">
                <h2>Страница продуктов</h2>
                <div class="row mb-2">
                    @foreach($products as $product)
                        <div class="card m-1" style="width: 18rem;">
                            <img src="/public/storage/{{$product->photo}}" width="100%" height="60%" class="card-img-top" alt="{{$product->name}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->name}}</h5>
                                <p class="card-text">Цена: {{$product->price}} руб.</p>
                                <a href="{{route('show',['product' => $product->id])}}" class="btn btn-primary">Подробнее</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{$products->links()}}
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
