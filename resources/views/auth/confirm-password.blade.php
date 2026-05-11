<x-guest-layout>
    <h2>Confirm Password</h2>
    <p>This is a secure area. Please confirm your password</p>

    <form method="POST" action="{{ route('password.confirm') }}">
    @csrf

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

    <div class="auth-actions" style="margin-top: 2rem;">
        <div class="auth-actions-right" style="width: 100%; text-align: right;">
            <button type="submit" class="btn-primary">
                Confirm
            </button>
        </div>
    </div>
    </form>
</x-guest-layout>
