@extends('layouts.master')
@section('content')
    <div class="sign section--bg" data-bg="{{asset('frontend-asset/img/section/section.jpg')}}">
        <div class="container mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- authorization form -->
                        <form method="POST" action="{{ route('login') }}" class="sign__form">
                            @csrf

                            <a href="index.html" class="sign__logo">
                                <img src="{{ asset('frontend-asset/img/logo.png') }}" alt="">
                            </a>

                            <div class="sign__group">
                                <input type="text" class="sign__input" name="email" placeholder="Email">
                                 <x-input-error :messages="$errors->get('email')"  class="sign__text mt-2" />
                            </div>

                            <div class="sign__group">
                                <input type="password" class="sign__input" name="password" placeholder="Password">
                                 <x-input-error :messages="$errors->get('password')" class="sign__text mt-2" />
                            </div>

                            <div class="sign__group sign__group--checkbox">
                                <input id="remember" name="remember" type="checkbox" checked="checked">
                                <label for="remember">Remember Me</label>
                            </div>

                            <button class="sign__btn" type="submit">Sign in</button>

                            <span class="sign__text">Don't have an account? <a href="{{ route('register') }}">Sign up!</a></span>

                            {{-- <span class="sign__text"><a href="#">Forgot password?</a></span> --}}
                        </form>
                        <!-- end authorization form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
