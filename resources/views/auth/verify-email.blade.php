<x-guest-layout>
    <h2>Verify Email</h2>
    <p>Thanks for signing up! Please verify your email address</p>

    <div style="margin-bottom: 1.5rem; padding: 1rem; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px; color: var(--slate-300); font-size: 0.875rem;">
        {{ __('We sent a verification link to your email. If you didn\'t receive it, we can send another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div style="margin-bottom: 1.5rem; padding: 1rem; background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.4); border-radius: 8px; color: #86efac; font-size: 0.875rem;">
            {{ __('A new verification link has been sent to your email address.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit" class="btn-primary" style="width: 100%; margin-bottom: 1rem;">
        {{ __('Resend Verification Email') }}
    </button>
</form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="auth-link" style="width: 100%; text-align: center; padding: 0.75rem; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; display: block;">
            {{ __('Log Out') }}
        </button>
    </form>
</x-guest-layout>
