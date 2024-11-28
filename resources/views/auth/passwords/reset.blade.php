@extends('layouts.auth')

@inject('Lang', 'App\Services\LanguageService')

@section('content')
    <div class="p-lg-5 p-4">
        <div class="text-center">
            <h5 class="mb-0">{{ $Lang->trans('reset_password') }}</h5>
        </div>

        <div class="mt-4">
            <form action="{{ route('password.update') }}" method="POST" class="auth-input">

                @include('layouts.alert')

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label for="username" class="form-label">{{ $Lang->trans('email') }}</label>
                    <input type="text" class="form-control" name="email" id="username"
                        placeholder="{{ $Lang->trans('enter_email') }}" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="mb-2">
                    <label for="userpassword" class="form-label">{{ $Lang->trans('password') }}</label>
                    <div class="position-relative auth-pass-inputgroup mb-3">
                        <input type="password" name="password" class="form-control pe-5 password-input"
                            placeholder="{{ $Lang->trans('enter_password') }}" id="password-input"
                            value="{{ old('password') }}" required>
                        <button
                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                            type="button" id="password-addon"><i class="las la-eye align-middle fs-18"></i></button>
                    </div>
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="mb-2">
                    <label for="userpassword" class="form-label">{{ $Lang->trans('password_confirmation') }}</label>
                    <div class="position-relative auth-pass-inputgroup mb-3">
                        <input type="password" name="password_confirmation" class="form-control pe-5 password-input"
                            placeholder="{{ $Lang->trans('enter_password_confirmation') }}"
                            id="password_confirmation-input" value="{{ old('password') }}" required>
                        <button
                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                            type="button" id="password-addon"><i class="las la-eye align-middle fs-18"></i></button>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>


                <div class="mt-2">
                    <button class="btn btn-primary w-100" type="submit">{{ $Lang->trans('confirm') }}</button>
                </div>
            </form>
        </div>

    </div>
@endsection
