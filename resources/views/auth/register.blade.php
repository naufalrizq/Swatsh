<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Register</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover;

        }

        body {
            background: rgb(219, 226, 226);
        }

        .row {
            background: white;
            border-radius: 30px;
        }
        card{
            border-top-left-radius:50px;
            border-bottom-left-radius:50px;
            border-radius: 4px;
        } 

        img {

            background: linear-gradient(180deg, #3730A3 0%, #312E81 100%);
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
            display: flex;
            

        }

        
        .btn1 {
            border: none;
            outline: none;
            height: 50px;
            width: 100%;
            background-color: navy;
            color: white;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn1:hover {
            background: white;
            border: 1px solid;
            color: black;
        }
    </style>
</head>

<body>
    <section class="Form py-5 my-5 px-5 mx-5">
        <div class="container">
            <div class="row no-gutters ">
                <div class="col-lg-5 card flex-row mx-0 my-0">
                    <img src="{{ asset('/storage/images/LogReg.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-7 px-5 pt-5">
                    <h1 class="font-weight-bold-py-2">Buat akun baru</h1>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col-lg-7">
                                <label for="name">Nama Lengkap</label>
                                <input id="name" type="text" placeholder="Nama lengkap"
                                    class="form-control my-1 p-2 mb-3 @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <label for="email">Email</label>
                                <input id="email" type="email" placeholder="Email-Address"
                                    class="form-control my-1 mb-3 p-2 @error('email')is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <label for="password">Password</label>
                                <input id="password" type="password" placeholder="*********"
                                    class="form-control my-1 mb-3 p-2 @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <label for="confirm-password">Confirm Password</label>
                                <input id="password-confirm" type="password" placeholder="*********"
                                    class="form-control my-1 mb-3 p-2 @error('password') is-invalid @enderror"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <button type="submit" class="btn1 mt-2 mb-3">
                                    {{ __('Mendaftar') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>


















    {{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
