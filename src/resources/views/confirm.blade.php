@extends('layouts.app')

@section('title', 'お問い合わせ内容確認')

@section('content')
<div class="contact-confirm">
    <h1 class="contact-confirm__title">Confirm</h1>

    <form action="{{ route('contact.store') }}" method="post" class="contact-confirm__form">
        @csrf

        {{-- 名前 --}}
        <div class="contact-confirm__item">
            <p class="contact-confirm__label">お名前</p>
            <p class="contact-confirm__text">{{ $inputs['last_name'] }}　{{ $inputs['first_name'] }}</p>
            <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">
            <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">
        </div>

        {{-- 性別 --}}
        <div class="contact-confirm__item">
            <p class="contact-confirm__label">性別</p>
            <p class="contact-confirm__text">
                @if($inputs['gender'] == 1) 男性
                @elseif($inputs['gender'] == 2) 女性
                @else その他
                @endif
            </p>
            <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
        </div>

        {{-- メール --}}
        <div class="contact-confirm__item">
            <p class="contact-confirm__label">メールアドレス</p>
            <p class="contact-confirm__text">{{ $inputs['email'] }}</p>
            <input type="hidden" name="email" value="{{ $inputs['email'] }}">
        </div>

        {{-- 電話番号 --}}
        <div class="contact-confirm__item">
            <p class="contact-confirm__label">電話番号</p>
            <p class="contact-confirm__text">{{ $inputs['tel'] }}</p>
            <input type="hidden" name="tel" value="{{ $inputs['tel'] }}">
        </div>


        {{-- 住所 --}}
        <div class="contact-confirm__item">
            <p class="contact-confirm__label">住所</p>
            <p class="contact-confirm__text">{{ $inputs['address'] }}</p>
            <input type="hidden" name="address" value="{{ $inputs['address'] }}">
        </div>

        {{-- 建物名 --}}
        <div class="contact-confirm__item">
            <p class="contact-confirm__label">建物名</p>
            <p class="contact-confirm__text">{{ $inputs['building'] }}</p>
            <input type="hidden" name="building" value="{{ $inputs['building'] }}">
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="contact-confirm__item">
            <p class="contact-confirm__label">お問い合わせの種類</p>
            <p class="contact-confirm__text">{{ $categories->firstWhere('id', $inputs['category_id'])->content }}</p>
            <input type="hidden" name="category_id" value="{{ $inputs['category_id'] }}">
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="contact-confirm__item">
            <p class="contact-confirm__label">お問い合わせ内容</p>
            <p class="contact-confirm__text">{{ $inputs['detail'] }}</p>
            <input type="hidden" name="detail" value="{{ $inputs['detail'] }}">
        </div>

        {{-- ボタン --}}
        <div class="contact-confirm__actions">
            <button type="submit" name="action" value="submit"
            class="contact-confirm__button contact-confirm__button--submit">
            送信
            </button>
            <button type="submit" name="action" value="back"
            class="contact-confirm__button-link">
            修正
            </button>
        </div>

    </form>
</div>
@endsection