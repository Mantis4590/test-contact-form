<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('index', compact('categories'));
    }
    public function confirm(ContactRequest $request) {
        $inputs = $request->validated();
        $categories = Category::all();
        return view('confirm', compact('inputs', 'categories'));
    }

    public function store(Request $request) {
        if ($request->input('action') === 'back') {
            return redirect()->route('contact.index')->withInput();
        }

        DB::table('contacts')->insert([
            'last_name' => $request->input('last_name'),
            'first_name' => $request->input('first_name'),'gender' => $request->input('gender'),'email' => $request->input('email'),
            'tel' => $request->input('tel'),
            'address' => $request->input('address'),
            'building' => $request->input('building'),'category_id' => $request->input('category_id'),'detail' => $request->input('detail'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view('thanks');
    }
}
