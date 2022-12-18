@extends('index')

@section('title', 'Страница добавления продукта')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                @if(isset($product))
                    <h2>Редактирование {{$product->name}}</h2>
                @else
                    <h2>Добавление продукта</h2>
                @endif
                <form method="post" action="{{(isset($product) ? route('admin.products.update', ['product' => $product->id]) : route('admin.products.store'))}}" enctype="multipart/form-data">
                    @csrf
                    @isset($product)
                        <input type="hidden" name="_method" value="PUT">
                    @endisset
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Наименование товара:</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Наименование товара: Компьютер" aria-describedby="invalidInputName" value="{{ old('name') }}">
                        @error('name') <div id="invalidInputName" class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputFile" class="form-label">Выберите изображение из товара:</label>
                        <input name="photo" class="form-control @error('photo') is-invalid @enderror" type="file" id="inputFile" aria-describedby="invalidInputFile">
                        @error('photo') <div id="invalidInputFile" class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputPrice" class="form-label">Стоимость товара:</label>
                        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="inputPrice" placeholder="Пример: 200" aria-describedby="invalidInputPrice" value="{{ old('price') }}">
                        @error('price') <div id="invalidInputPrice" class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputDescription" class="form-label">Описание товара:</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="inputDescription" rows="3" aria-describedby="invalidInputDescription">{{old('description')}}</textarea>
                        @error('description') <div id="invalidInputDescription" class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($product))
                            Отредактировать товар
                        @else
                            Создать новый товар
                        @endif
                    </button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
