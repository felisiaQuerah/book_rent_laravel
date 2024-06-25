<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use TextAnalysis\Documents\TokensDocument;
use TextAnalysis\Tokenizers\WhitespaceTokenizer;

class UserController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $datas = Book::where('is_active', 1)->get();
        return view('guest.home', compact('datas'));
    }

    public function search($key)
    {
        $datas = Book::where('title', 'like', '%' . $key . '%')->get();
        return view('guest.home', compact('datas','key'));
    }

    public function history()
    {
        $data = Auth::user()->rents;
        return view('guest.history', compact('data'));
    }

    public function rent($id)
    {
        // jika belum login
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $book = Book::find($id);
        return view('guest.rent', compact('book'));
    }

    public function rentBook(Request $request, $id)
    {
        $request->validate([
            'rented_at' => 'required',
            'returned_at' => 'required',
        ]);

        //cek ada buku tidak
        $book = Book::find($id);
        if(!$book){
            return redirect()->route('user.history')->with('message', [
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ]);
        }

        $rent = new Rent();
        $rent->book_id = $id;
        $rent->user_id = Auth::id();
        $rent->rented_at = $request->rented_at;
        $rent->returned_at = $request->returned_at;
        $rent->save();

        return redirect()->route('user.history')->with('message', [
            'success' => true,
            'message' => 'Buku berhasil disewa'
        ]);
    }


}
