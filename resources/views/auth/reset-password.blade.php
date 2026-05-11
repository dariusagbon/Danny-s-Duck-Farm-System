<x-guest-layout>
    <h2>Reset Password</h2>
    <p>Enter your new password to regain access</p>

    <form method="POST" action="{{ route('password.store') }}">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <!-- Email Address -->
    <div class="auth-group">
        <label for="email" class="auth-label">Email Address</label>
        <input 
            id="email" 
            class="auth-input" 
            type="email" 
            name="email" 
            value="{{ old('email', $request->email) }}" 
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
        <label for="password" class="auth-label">New Password</label>
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

    <div class="auth-actions" style="margin-top: 2rem;">
        <div class="auth-actions-right" style="width: 100%; text-align: right;">
            <button type="submit" class="btn-primary">
                Reset Password
            </button>
        </div>
    </div>
    </form>
</x-guest-layout>
