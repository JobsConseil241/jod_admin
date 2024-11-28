@extends('layouts.auth')

@inject('Lang', 'App\Services\LanguageService')

@push('styles')
@endpush

@section('content')
    <div class="p-lg-5 p-4">
        <div class="text-center">
            <h5 class="mb-0">{{ $Lang->trans('forget_password') }}</h5>
        </div>

        <div class="mt-4">
            <form action="{{ route('password.email') }}" method="POST" class="auth-input">

                @include('layouts.alert')

                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">{{ $Lang->trans('email') }}</label>
                    <input type="text" class="form-control" name="email" id="username"
                        placeholder="{{ $Lang->trans('enter_email') }}" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="mt-2">
                    <button class="btn btn-primary w-100" type="submit">{{ $Lang->trans('send') }}</button>
                </div>

                <div class="mt-4 text-center">
                    <p class="mb-0">{{ $Lang->trans('remember_account') }} <a href="{{ route('login') }}"
                            class="fw-medium text-primary text-decoration-underline">{{ $Lang->trans('signin_now') }}</a>
                    </p>
                </div>
            </form>
        </div>

    </div>
@endsection
