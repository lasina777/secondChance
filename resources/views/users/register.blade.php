@extends('index')

@section('title', 'Страница регистрации')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-10">
                <h2>Регистрация нового пользователя</h2>
                @auth
                    <div class="alert alert-primary">Вы уже авторизированы. Регистрация не возможна</div>
                @endauth
                @guest
                    <form method="POST" action="{{route('register')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Ваше Имя:</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" aria-describedby="invalidNameFeedback" value="{{old('name')}}">
                            @error('name')<div id="invalidNameFeedback" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputPhone" class="form-label">Телефон:</label>
                            <div class="small">Номер телефона необходимо написать с плюсом</div>
                            <input maxlength="12" type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" id="inputPhone" aria-describedby="invalidPhoneFeedback" value="{{old('phone')}}">
                            @error('phone')<div id="invalidPhoneFeedback" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Электронная почта:</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" aria-describedby="invalidEmailFeedback" value="{{old('email')}}">
                            @error('email')<div id="invalidEmailFeedback" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Пароль:</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" aria-describedby="invalidPasswordFeedback">
                            @error('password')<div id="invalidPasswordFeedback" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputPasswordConfirmation" class="form-label">Повтор пароля:</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="inputPasswordConfirmation" aria-describedby="invalidPasswordConfirmationFeedback">
                            @error('password')<div id="inputPasswordConfirmation" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputAddress" class="form-label">Ваш адресс:</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="inputAddress" aria-describedby="invalidAddressFeedback" value="{{old('address')}}">
                            @error('address')<div id="invalidAddressFeedback" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Регистрация</button>
                    </form>
                @endguest
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
