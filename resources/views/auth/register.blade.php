<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    
    <header>
        <div class="link">
            <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </div>
        <div class="qoute">
            <h2>Feel free to create an account!</h2>
        </div>
    </header>
    
    <main>
        <div class="content-left">
            <img src="{{ asset('image/signin.svg') }}" alt="model" class="model">
        </div>
    
        <div class="content-right">
            <form method="POST" action="{{ route('register') }}">
                @csrf
    
                <h3>Register</h3>
    
                <label for="name">Username:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                <x-input-error :messages="$errors->get('name')" />
    
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                <x-input-error :messages="$errors->get('email')" />
    
                <div class="gender-group">
                    <label>Gender:</label>
                    <input type="radio" id="male" name="gender" value="male" required>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="female" required>
                    <label for="female">Female</label>
                </div>
    
                <label for="birthdate">Birthdate:</label>
                <input type="date" id="birthdate" name="birthdate" required>
    
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <x-input-error :messages="$errors->get('password')" />
    
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                <x-input-error :messages="$errors->get('password_confirmation')" />
    
                <button type="submit">Register</button>
    
                <footer>
                    <p>By signing up, you agree to our <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>.</p>
                </footer>
            </form>
        </div>
    </main>
</x-guest-layout>
