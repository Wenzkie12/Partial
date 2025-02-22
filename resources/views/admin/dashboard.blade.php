<x-app-layout>
    @section('content')
    
    <div class="welcome-message">
        <h2>Welcome back, {{ auth()->user()->name }}!</h2>
        <p>We’re glad to have you back. Let’s make today amazing!</p>
    </div>
    

    @endsection
</x-app-layout>
