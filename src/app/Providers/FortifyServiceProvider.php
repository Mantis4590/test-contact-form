<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\LoginRequest;

class FortifyServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);
    }

    public function boot() {
        Fortify::registerView(fn () => view('auth.register'));
        Fortify::loginView(fn () => view('auth.login'));

        // ログイン時の認証処理のカスタマイズ
        Fortify::authenticateUsing(function (Request $request) {
            // LoginRequest のルール・メッセージでバリデーション
            $loginReq = app(LoginRequest::class);
            Validator::make(
                $request->all(),
                $loginReq->rules(),
                $loginReq->messages()
            )->validate();

            if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
                return Auth::user();
            }

            return null;
        });
    }
}
