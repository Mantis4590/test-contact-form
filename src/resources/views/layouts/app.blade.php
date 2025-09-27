{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'お問い合わせフォーム')</title>
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>
    @unless (View::hasSection('hideHeader'))
  <header class="header">
    <h1 class="header__title">FashionablyLate</h1>
    <div class="header-right">
            @if (Route::currentRouteName() === 'register')
                {{-- 登録ページにいるときは「login」ボタン --}}
                <form action="{{ route('login') }}" method="GET">
                    <button class="login-button" type="submit">login</button>
                </form>
            @elseif (Route::currentRouteName() === 'login')
                {{-- ログインページにいるときは「register」ボタン --}}
                <form action="{{ route('register') }}" method="GET">
                    <button class="login-button" type="submit">register</button>
                </form>
                @elseif (Route::currentRouteName() === 'admin.admin')
                {{-- 管理画面にいるときは「logout」ボタン --}}
                <form action="{{ route('logout') }}" method="POST">
                @csrf
                    <button class="login-button" type="submit">logout</button>
                </form>
                @endif
            </div>
  </header>
  @endunless

  <main class="main">
    @yield('content')
  </main>

</body>
</html>
