@extends('layouts.app')

@section('content')
<div class="contact">
  <h1 class="contact__title">Contact</h1>
  <form action="{{ route('contact.confirm') }}" method="POST" class="contact-form">
    @csrf

    {{-- 名前 --}}
    <div class="contact-form__item">
  <label class="contact-form__label">お名前 <span class="contact-form__required">※</span></label>
  
  <div class="contact-form__input-group">
    <div class="contact-form__input-wrapper">
        <input type="text" name="last_name" class="contact-form__input" placeholder="例: 山田" value="{{ old('last_name') }}">
        @error('last_name')
        <p class="contact-form__error">{{ $message }}</p>
        @enderror
    </div>

    <div class="contact-form__input-wrapper">
        <input type="text" name="first_name" class="contact-form__input" placeholder="例: 太郎" value="{{ old('first_name') }}">
        @error('first_name')
        <p class="contact-form__error">{{ $message }}</p>
        @enderror
    </div>
  </div>
</div>


    {{-- 性別 --}}
    <div class="contact-form__item">
      <label class="contact-form__label">性別 <span class="contact-form__required">※</span></label>
      <div class="contact-form__input-wrapper">
        <div class="contact-form__radios">
          <label><input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}> 男性</label>
          <label><input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}> 女性</label>
          <label><input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}> その他</label>
        </div>
        @error('gender')
          <p class="contact-form__error">{{ $message }}</p>
        @enderror
      </div>
    </div>

    {{-- メール --}}
    <div class="contact-form__item">
      <label class="contact-form__label">メールアドレス <span class="contact-form__required">※</span></label>
      <div class="contact-form__input-wrapper">
        <input type="email" name="email" class="contact-form__input" placeholder="例: test@example.com" value="{{ old('email') }}">
        @error('email')
          <p class="contact-form__error">{{ $message }}</p>
        @enderror
      </div>
    </div>

    {{-- 電話番号 --}}
    <div class="contact-form__item">
      <label class="contact-form__label">電話番号 <span class="contact-form__required">※</span></label>
      <div class="contact-form__input-wrapper">
        <input type="text" name="tel" class="contact-form__input" placeholder="例: 08012345678" value="{{ old('tel') }}">
        @error('tel')
          <p class="contact-form__error">{{ $message }}</p>
        @enderror
      </div>
    </div>

    {{-- 住所 --}}
    <div class="contact-form__item">
      <label class="contact-form__label">住所 <span class="contact-form__required">※</span></label>
      <div class="contact-form__input-wrapper">
        <input type="text" name="address" class="contact-form__input" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
        @error('address')
          <p class="contact-form__error">{{ $message }}</p>
        @enderror
      </div>
    </div>

    {{-- 建物名 --}}
    <div class="contact-form__item">
      <label class="contact-form__label">建物名</label>
      <div class="contact-form__input-wrapper">
        <input type="text" name="building" class="contact-form__input" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
      </div>
    </div>

    {{-- お問い合わせ種類 --}}
    <div class="contact-form__item">
      <label class="contact-form__label">お問い合わせの種類 <span class="contact-form__required">※</span></label>
      <div class="contact-form__input-wrapper">
        <select name="category_id" class="contact-form__select">
          <option value="">選択してください</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->content }}
            </option>
          @endforeach
        </select>
        @error('category_id')
          <p class="contact-form__error">{{ $message }}</p>
        @enderror
      </div>
    </div>

    {{-- お問い合わせ内容 --}}
    <div class="contact-form__item">
      <label class="contact-form__label">お問い合わせ内容 <span class="contact-form__required">※</span></label>
      <div class="contact-form__input-wrapper">
        <textarea name="detail" class="contact-form__textarea" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
        @error('detail')
          <p class="contact-form__error">{{ $message }}</p>
        @enderror
      </div>
    </div>

    <div class="contact-form__actions">
      <button type="submit" class="contact-form__button">確認画面</button>
    </div>

  </form>
</div>
@endsection
