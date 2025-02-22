<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <header>
        <div class="link">
            <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
        </div>
        <div class="qoute">
            <h2>Welcome back! Please sign in.</h2>
        </div>
    </header>
    <main>
        <div class="content-left">
            <img src={{ asset('image/login.svg') }} alt="model" class="model">
        </div>
        <div class="content-right">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <h3>Login</h3>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                
                <div class="remember-me">
                    <input type="checkbox" id="remember_me" name="remember">
                    <label for="remember_me">Remember Me</label>
                </div>
                
                <button type="submit">Login</button>
                
                <footer>
                    <p><a href="{{ route('password.request') }}">Forgot your password?</a></p>
                </footer>
            </form>
        </div>
    </main>
</x-guest-layout>
