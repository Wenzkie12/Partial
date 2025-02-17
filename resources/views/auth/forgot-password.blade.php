<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <main>
        <div class="content-right">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <h2 class="form-title">Forgot Password?</h2>
                <p class="form-description">
                    Enter your email address, and we'll send you a link to reset your password.
                </p>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit">Send Password Reset Link</button>

                <footer>
                    <a href="{{ route('login') }}">Back to Login</a>
                </footer>
            </form>
        </div>
    </main>
</x-guest-layout>
