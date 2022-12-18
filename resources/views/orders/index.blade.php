@extends('index')

@section('title', 'Страница заказов')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-8">
                @if(session()->has('completed'))
                    <div class="alert alert-success">Заказ готов!</div>
                @endif
                @if(session()->has('cancel'))
                    <div class="alert alert-success">Заказ успешно завершен!</div>
                @endif
                @if(session()->has('cooking'))
                    <div class="alert alert-success">Заказ готовится!</div>
                @endif

                @if(Auth::user()->role == 'Клиент')
                    <h2>Мои заказы</h2>
                @else
                    <h2>Заказы</h2>
                @endif

                <div class="accordion" id="accordionPanelsStayOpenExample">
                    @forelse( $orders as $key => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#order_{{$key}}" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                    <div class="p-1">Номер заказа: {{$item->id}}</div>
                                    @if($item->status == 'Готов')
                                        <div class="bg-danger text-white ml-1 p-1 rounded-2">Статус: {{$item->status}}</div>
                                    @elseif($item->status == 'В обработке')
                                        <div class="bg-success text-white ml-1 p-1 rounded-2">Статус: {{$item->status}}</div>
                                    @elseif($item->status == 'Завершен')
                                        <div class="bg-black text-white ml-1 p-1 rounded-2">Статус: {{$item->status}}</div>
                                    @else
                                        <div class="bg-secondary text-white ml-1 p-1 rounded-2">Статус: {{$item->status}}</div>
                                    @endif
                                </button>
                            </h2>
                            <div id="order_{{$key}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Название товара</th>
                                            <th scope="col">Стоимость товара</th>
                                            <th scope="col">Количество</th>
                                            <th scope="col">Общая сумма</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $summa = 0; ?>
                                        @foreach($item->items as $subkey => $product)
                                            <?php $summa += ($product->column*$product->price); ?>
                                            <tr>
                                                <th scope="row">{{$subkey}}</th>
                                                <td>{{$product->product->name}}</td>
                                                <td>{{number_format($product->price, 2, ',', ' ')}}</td>
                                                <td>{{$product->column}}</td>
                                                <td>{{number_format($product->column*$product->price, 2, ',', ' ')}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th colspan="5">Общая стоимость за весь заказ: {{number_format($summa, 2, ',', ' ')}}</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <ul class="list-group">
                                        <li class="list-group-item">Заказ номер: {{$item->id}}</li>
                                        <li class="list-group-item">Статус заказа: {{$item->status}}</li>
                                        <li class="list-group-item">Дата заказа: {{$item->created_at}}</li>
                                        <li class="list-group-item">Дата изменения: {{$item->updated_at}}</li>
                                        <li class="list-group-item">Адресс доставки: {{$item->address}}</li>
                                    </ul>
                                    @if(Auth::user()->role == 'Администратор')
                                        @if($item->status == 'Приготовление')
                                            <a href="{{route('completed', ['order' => $item->id])}}" class="btn btn-success mt-1">Заказ готов</a>
                                        @endif
                                        @if($item->status == 'Готов')
                                            <a href="{{route('cancel', ['order' => $item->id])}}" class="btn btn-danger mt-1">Заказ завершен</a>
                                        @endif
                                        @if($item->status == 'В обработке')
                                            <a href="{{route('cooking', ['order' => $item->id])}}" class="btn btn-primary mt-1">Приготовление</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger">Вы не сделали ни одного заказа</div>
                    @endforelse
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
