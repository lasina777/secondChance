@extends('index')

@section('title', 'Страница авторизации')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-10">
                <h2>Авторизация пользователя</h2>
                @auth
                    <div class="alert alert-primary">Вы уже авторизированы. Авторизация не возможна</div>
                @endauth
                @guest
                    <form method="POST" action="{{route('login')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="inputPhone" class="form-label">Телефон:</label>
                            <input maxlength="12" type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" id="inputPhone" aria-describedby="invalidPhoneFeedback" value="{{old('phone')}}">
                            @error('phone')<div id="invalidPhoneFeedback" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Пароль:</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" aria-describedby="invalidPasswordFeedback">
                            @error('password')<div id="invalidPasswordFeedback" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Авторизация</button>
                    </form>
                @endguest
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
