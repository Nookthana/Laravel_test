<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
        <x-slot name="logo">
        </x-slot>
<div class="container pt-2">

            <h2>{{ __('Forgot your password?') }}</h2>
  

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <strong class="text-danger"><x-auth-validation-errors class="mb-4" :errors="$errors" /></strong>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-success">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
</div>
