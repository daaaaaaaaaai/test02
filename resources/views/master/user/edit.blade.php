@extends('adminlte::auth.auth-page', ['authType' => 'register'])

@section('title', __('User Control'))

@section('content_header')
    <h1>{{__('User Create')}}</h1>
@stop

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')

    <form method="post" action="{{route('user.update',$user)}}">
        @csrf
        @method('patch')

        {{-- UserID field --}}
        <div class="input-group mb-3">
            <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror"
                readonly value="{{ old('user_id',$user->user_id) }}" placeholder="{{ __('adminlte::adminlte.user_id') }}" autofocus>

            @error('user_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- LastName field --}}
        <div class="input-group mb-3">
            <input type="text" name="name_last" class="form-control @error('name_last') is-invalid @enderror"
                value="{{ old('name_last',$user->name_last) }}" placeholder="{{ __('adminlte::adminlte.name_last') }}" autofocus>

            @error('name_last')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- FirstName field --}}
        <div class="input-group mb-3">
            <input type="text" name="name_first" class="form-control @error('name_first') is-invalid @enderror"
                value="{{ old('name_first',$user->name_first) }}" placeholder="{{ __('adminlte::adminlte.name_first') }}" autofocus>

            @error('name_first')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email',$user->email) }}" placeholder="{{ __('adminlte::adminlte.email') }}">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register_change') }}
        </button>
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop