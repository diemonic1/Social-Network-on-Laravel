@extends('Layouts.main')

@section('title')
    <title>ASN | Edit Gender</title>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Редактирование аватара') }}</div>

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('user.updateAvatar') }}">
                            @csrf
                            @method('patch')
                            <div class="row mb-3">
                                <label for="avatar" class="col-md-4 col-form-label text-md-end">{{ __('Аватар') }}</label>

                                <div class="col-md-6">
                                    <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" required autocomplete="avatar">

                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <p>максимум 2 mb</p>
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
