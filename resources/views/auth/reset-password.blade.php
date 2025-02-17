<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <main>
        <div class="content-right">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <h2 class="form-title">Reset Password</h2>
                <p class="form-description">
                    Enter your new password below to reset your account.
                </p>

                <!-- Hidden Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus>
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input id="password" type="password" name="password" required>
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required>
                    @error('password_confirmation')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit">Reset Password</button>

                <footer>
                    <a href="{{ route('login') }}">Back to Login</a>
                </footer>
            </form>
        </div>
    </main>
</x-guest-layout>
