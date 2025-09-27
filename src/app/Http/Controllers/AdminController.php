<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request) {
        $query = Contact::query();
        // 検索条件を受け取って処理するイメージ
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
    

        $query->where(function ($q) use ($keyword) {
            $q->where('last_name', 'like', "%{$keyword}%")
            ->orWhere('first_name', 'like', "%{$keyword}%")
            ->orWhere('email', 'like', "%{$keyword}%")
            // フルネーム (スペースなし)
            ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"])
            // フルネーム (半角スペース)
            ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"])
            // フルネーム (全角スペース)
            ->orWhereRaw("CONCAT(last_name, '　', first_name) LIKE ?", ["%{$keyword}%"]);
        });
    }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->Where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->WhereDate('created_at', $request->date);
        }

        // ページネーション(7件ごと)
        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view('admin.admin', compact('contacts', 'categories'));
    }

    public function export(Request $request) {
        // index と同じ検索条件を適用
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', "%{$request->keyword}%")
                  ->orWhere('first_name', 'like', "%{$request->keyword}%")
                  ->orWhere('email', 'like', "%{$request->keyword}%");
            });
        }

        if ($request->filled('gender') && $request->gender != 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->with('category')->get();
        
        // CSVストリームレスポンス
        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            // ヘッダー行
            fputcsv($handle, [
                'ID', '姓', '名', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせ種類', 'お問い合わせ内容', '登録日時'
            ]);

            // データ行
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->last_name,$contact->first_name,$contact->gender_label,$contact->email,$contact->tel,$contact->address,$contact->building,$contact->category->content ?? '',$contact->detail,$contact->created_at,
                ]);
            }

            fclose($handle);
        });

        $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';

        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', "attachment; filename={$filename}");

        return $response;

    }

    public function destroy($id) {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.admin')->with('success', '削除しました');
    }
}
