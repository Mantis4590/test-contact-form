@extends('layouts.app')

@section('hideHeader')@endsection

@section('title', '送信完了')

@section('content')
<div class="contact-thanks">
    <h1 class="contact-thanks__title">お問い合わせありがとうございました</h1>

    <div class="contact-thanks__actions">
        <a href="{{ route('contact.index') }}" class="contact-thanks__button">HOME</a>
    </div>
</div>
@endsection