{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 sign__text" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 sign__text" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 sign__text" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 sign__text" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.master')

@section('content')
    <div class="sign section--bg" data-bg="{{ asset('frontend-asset/img/section/section.jpg') }}">
        <div class="container mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- registration form -->
                        <form action="#" method="POST" enctype="multipart/form-data" class="sign__form">
                            @csrf

                            <a href="index.html" class="sign__logo">
                                <img src="{{ asset('frontend-asset/img/logo.png') }}" alt="">
                            </a>

                            <div class="sign__group">
                                <input type="text" class="sign__input" placeholder="Name" name="name">
                                 <x-input-error :messages="$errors->get('name')" class="mt-2 sign__text" />
                            </div>

                            <div class="sign__group">
                                <input type="text" class="sign__input" placeholder="Email" name="email">
                                 <x-input-error :messages="$errors->get('email')" class="mt-2 sign__text" />
                            </div>

                            <div class="sign__group">
                                <input type="password" class="sign__input" placeholder="Password" name="password">
                                 <x-input-error :messages="$errors->get('password')" class="mt-2 sign__text" />
                            </div>
                            <div class="sign__group">
                                <input type="password" class="sign__input" placeholder="Password Confirmation" name="password_confirmation">
                                 <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 sign__text" />
                            </div>
                            <div class="sign__group">
                                <input type="file" id="profileImage" class="sign__input" name="profile_image"
                                    accept="image/*">
                                     <x-input-error :messages="$errors->get('profile_image')" class="mt-2 sign__text" />
                            </div>

                            <!-- Preview Image -->
                            <div class="sign__group" style="text-align: center;">
                                <img id="previewImage" src="{{ asset('frontend-asset/img/default-avatar.png') }}"
                                    alt="Profile Preview"
                                    style="width:100px; height:100px; object-fit:cover; border-radius:50%; display:none;">
                            </div>

                            <button class="sign__btn" type="submit">Sign up</button>

                            <span class="sign__text">Already have an account?
                                <a href="{{ route('login') }}">Sign in!</a>
                            </span>
                        </form>
                        <!-- registration form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById('profileImage').addEventListener('change', function(event) {
            let reader = new FileReader();
            let file = event.target.files[0];
            let preview = document.getElementById('previewImage');

            if (file) {
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>
@endpush
