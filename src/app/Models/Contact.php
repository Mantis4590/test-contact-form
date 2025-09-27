<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail',
    ];

    // 性別マスタ(画面表示用)
    public const GENDER_LABEL = [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
    ];

    // アクセサ:$contact->gender_label で呼べるようにする
    public function getGenderLabelAttribute(): string {
        return self::GENDER_LABEL[$this->gender] ?? 'その他';
    }

    // カテゴリとのリレーション
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
