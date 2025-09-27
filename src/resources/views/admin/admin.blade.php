@extends('layouts.app')

@section('title', 'admin')

@section('content')

<div class="admin">

    <div class="admin-title">
        <h1 class="admin-title__content">Admin</h1>
    </div>


    {{-- 検索フォーム --}}
    <form method="GET" action="{{ route('admin.admin') }}" class="admin-search">
        <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください">
        <select name="gender">
            <option value="">性別</option>
            <option value="all">全て</option>
            <option value="1">男性</option>
            <option value="2">女性</option>
            <option value="3">その他</option>
        </select>

        <select name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->content }}</option>
            @endforeach
        </select>
        <input type="date" name="date">
        <button type="submit">検索</button>
        <a href="{{ route('admin.admin') }}">リセット</a>
    </form>

    <a href="{{ route('admin.export', request()->query()) }}" class="export-btn">エクスポート</a>


    {{-- ページメーション --}}
    {{ $contacts->links() }}

    {{-- データ一覧 --}}
    <table class="admin-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>{{ $contact->gender_label }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content }}</td>
                <td>
                    {{-- チェックボックス + 詳細ボタン --}}
                    <input type="checkbox" id="modal-toggle-{{ $contact->id }}" class="modal-toggle">
                    <label for="modal-toggle-{{ $contact->id }}" class="detail-btn">詳細</label>

                    {{-- モーダル本体 --}}
                    <div class="modal">
                        <div class="modal-content">
                            <label for="modal-toggle-{{ $contact->id }}" class="modal-close">×</label>
                            <div class="modal-row">
                                <span class="label">お名前</span>
                                <span class="value">{{ $contact->last_name }} {{ $contact->first_name }}
                                </span>
                            </div>
                            <div class="modal-row">
                                <span class="label">性別</span>
                                <span class="value">{{ $contact->gender_label }}</span>
                            </div>
                            <div class="modal-row">
                                <span class="label">メールアドレス</span>
                                <span class="value">{{ $contact->email }}</span>
                            </div>
                            <div class="modal-row">
                                <span class="label">電話番号</span>
                                <span class="value">{{ $contact->tel }}</span>
                            </div>
                            <div class="modal-row">
                                <span class="label">住所</span>
                                <span class="value">{{ $contact->address }}</span>
                            </div>
                            <div class="modal-row">
                                <span class="label">建物名</span>
                                <span class="value">{{ $contact->building }}</span>
                            </div>
                            <div class="modal-row">
                                <span class="label">お問い合わせの種類</span>
                                <span class="value">{{ $contact->category->content }}</span>
                            </div>
                           <div class="modal-row">
                                <span class="label">お問い合わせ内容</span>
                                <span class="value">{{ $contact->detail }}</span>
                            </div>



                            {{-- 削除ボタン --}}
                            <form method="POST" action="{{ route('admin.delete', $contact->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">削除</button>
                            </form>
                            
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection