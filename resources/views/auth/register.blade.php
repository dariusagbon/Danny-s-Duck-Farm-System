<x-guest-layout>
    <h2>Create Account</h2>
    <p>Join Danny's Duck Farm Management System</p>

    <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div class="auth-group">
        <label for="name" class="auth-label">Full Name</label>
        <input 
            id="name" 
            class="auth-input" 
            type="text" 
            name="name" 
            value="{{ old('name') }}" 
            required 
            autofocus 
            autocomplete="name"
            placeholder="Your full name" />
        @error('name')
            <div class="auth-error">{{ $message }}</div>
        @enderror
    </div>

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
            autocomplete="new-password"
            placeholder="Create a strong password" />
        @error('password')
            <div class="auth-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="auth-group">
        <label for="password_confirmation" class="auth-label">Confirm Password</label>
        <input 
            id="password_confirmation" 
            class="auth-input"
            type="password"
            name="password_confirmation" 
            required 
            autocomplete="new-password"
            placeholder="Confirm your password" />
        @error('password_confirmation')
            <div class="auth-error">{{ $message }}</div>
        @enderror
    </div>

    <div class="auth-actions">
        <div class="auth-actions-left">
            <a class="auth-link" href="{{ route('login') }}">
                Already registered?
            </a>
        </div>
        <div class="auth-actions-right">
            <button type="submit" class="btn-primary">
                Create Account
            </button>
        </div>
    </div>

    <div class="auth-footer">
        By signing up, you agree to our Terms of Service
    </div>
    </form>
</x-guest-layout>
