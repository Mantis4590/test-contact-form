@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="auth-card">
    <div class="auth-content">
        <h1 class="auth-title">Login</h1>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" placeholder="例: coachtech1106" value="{{ old('password') }}">
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-actions">
            <button class="btn-submit">ログイン</button>
        </div>
    </form>
</div>
@endsection