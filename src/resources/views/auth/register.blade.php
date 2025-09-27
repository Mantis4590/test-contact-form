@extends('layouts.app')


@section('title', 'Register')



@section('content')



<div class="all">
    <div class="register">
        <h1>Register</h1>

        <form action="{{ route('register') }}" method="POSt">
        @csrf

        {{-- お名前 --}}
            <div>
                
                <label>お名前</label>
                <input type="text" name="name" placeholder="例: 山田　太郎"  value="{{ old('name') }}">
                @error('name')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- メールアドレス --}}
            <div>
                <label>メールアドレス</label>
                <input type="email" name="email" placeholder="例: test@example.com"  value="{{ old('email') }}">
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- パスワード --}}
            <div>
                <label>パスワード</label>
                <input type="password" name="password" placeholder="例: coachtech1106" >
                @error('password')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">登録</button>
    </form>
    </div>
</div>
@endsection