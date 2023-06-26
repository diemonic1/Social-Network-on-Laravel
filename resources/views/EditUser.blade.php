@extends('Layouts.main')

@section('title')
    <title>ASN | Edit Profile</title>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Редактирование профиля') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update') }}">
                            @csrf
                            @method('patch')
                            <div class="card-header">
                                <div class="row mb-3">
                                    <label for="oldPassword" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

                                    <div class="col-md-6">
                                        <input maxlength='250' id="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword" required autocomplete="oldPassword" autofocus>

                                        @error('oldPassword')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <p>Вставьте новые значения туда, где хотите что-то изменить</p>
                            <div class="row mb-3">
                                <label for="login" class="col-md-4 col-form-label text-md-end">{{ __('Новый логин') }}</label>

                                <div class="col-md-6">
                                    <input maxlength='250' id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ (old('login') != '') ? old('login') : $user->login }}" autocomplete="login">

                                    @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Новые имя и фамилия') }}</label>

                                <div class="col-md-6">
                                    <input maxlength='22' id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ (old('name') != '') ? old('name') : $user->name }}" autocomplete="name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Новый Email') }}</label>

                                <div class="col-md-6">
                                    <input maxlength='250' id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ (old('email') != '') ? old('email') : $user->email }}" autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Новый пароль') }}</label>

                                <div class="col-md-6">
                                    <input maxlength='250' id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <p>минимум 4 символа</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Повторите новый пароль') }}</label>

                                <div class="col-md-6">
                                    <input maxlength='250' id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Изменить') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
