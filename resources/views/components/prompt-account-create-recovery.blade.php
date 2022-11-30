<div class="w-100 text-center">
    <p class="mb-1">Don't have an account? <a href="{{ route('register') }}">{{ __('Register') }}</a></p>
    @if (Route::has('password.request'))
        @if (boolval(Route::current()->getName() !== 'password.request'))
            <p><a href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a></p>
        @endif
    @endif
</div>