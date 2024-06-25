@extends('layouts.my_layout')
@section('title', 'Home')
@section('content')
<?php
$is_login = session('is_login') ? session('is_login') : false;
if($is_login) {
    //clear
    session()->forget('is_login');

}
?>
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-2" :status="session('status')" />

    @include('components.flash-message')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="input-group mb-3">
                <input id="password" class="form-control"
                       type="password"
                       name="password"
                       required autocomplete="current-password" />
                <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()"><i class="bi bi-eye-slash" id="togglePassword"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@endsection
@section('scripts')
<script>
    $(".mx-auto").css("width", "100px");
    $(".min-h-screen").css("height", "80vh");
    $(".min-h-screen").removeClass('min-h-screen');
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var eyeIcon = document.getElementById("eye-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("bi-eye");
            eyeIcon.classList.add("bi-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("bi-eye-slash");
            eyeIcon.classList.add("bi-eye");
        }
    }
    // sembunyikan div img
    $(document).ready(function() {
        $("div.flex").find("img").hide();
    });

</script>
@endsection
