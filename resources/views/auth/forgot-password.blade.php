<x-guest-layout>
    <h2>Forgot Password?</h2>
    <p>No problem. Enter your email and we'll send you a reset link</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
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
            placeholder="you@example.com" />
        @error('email')
            <div class="auth-error">{{ $message }}</div>
        @enderror
    </div>

    <div class="auth-actions">
        <div class="auth-actions-left">
            <a class="auth-link" href="{{ route('login') }}">
                Back to login
            </a>
        </div>
        <div class="auth-actions-right">
            <button type="submit" class="btn-primary">
                Send Reset Link
            </button>
        </div>
    </div>
    </form>
</x-guest-layout>
