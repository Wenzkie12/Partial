@extends('layouts.app')

@section('content')
<link rel="stylesheet" href={{ asset('css/profile.css') }}>
    <div class="profile-container">
        <div class="profile-content">
            <div class="profile-section">
                <div class="profile-form">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="profile-section">
                <div class="profile-form">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="profile-section">
                <div class="profile-form">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
