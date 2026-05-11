<x-guest-layout>
    <h2>Welcome Back</h2>
    <p>Sign in to your account to continue</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div class="auth-group">
        <label for="email" class="auth-label">Email Address</label>
        <input 
            id="email" 
            class="auth-input" 
            type="email" 
            name="email" 
            value="{{ old('email') }}" 
            required 
            autofocus 
            autocomplete="username"
            placeholder="you@example.com" />
        @error('email')
            <div class="auth-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="auth-group">
        <label for="password" class="auth-label">Password</label>
        <input 
            id="password" 
            class="auth-input"
            type="password"
            name="password"
            required 
            autocomplete="current-password"
            placeholder="Enter your password" />
        @error('password')
            <div class="auth-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="auth-checkbox">
        <input 
            id="remember_me" 
            type="checkbox" 
            name="remember">
        <label for="remember_me">Remember me</label>
    </div>

    <div class="auth-actions">
        <div class="auth-actions-left">
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>
        <div class="auth-actions-right">
            <button type="submit" class="btn-primary">
                Sign In
            </button>
        </div>
    </div>

    <div class="auth-footer">
        Don't have an account? <a href="{{ route('register') }}" class="auth-link">Sign up</a>
    </div>
    </form>
</x-guest-layout>
