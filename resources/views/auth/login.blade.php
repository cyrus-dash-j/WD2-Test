<x-guest-layout>
    <h2>Sign in</h2>
    <p>Access student record management tools.</p>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="block mt-4"><label for="remember_me" class="inline-flex items-center"><input id="remember_me" type="checkbox" class="rounded border-gray-300" name="remember"><span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span></label></div>
        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))<a class="auth-link" href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>@endif
            <button type="submit" class="auth-button">{{ __('Log in') }}</button>
        </div>
    </form>
    <p style="margin-top: 24px; margin-bottom: 0;">New here? <a class="auth-link" href="{{ route('register') }}">Create an account</a></p>
</x-guest-layout>
