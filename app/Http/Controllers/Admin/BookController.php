<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Setting;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $data  = Book::where('is_active', 1)->get();
        return view('admin.books.index', compact('data'));
    }

    public function create()
    {

        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required', 
            'author' => 'required',
            'description' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'published_at' => 'required',
        ]);

        // upload image
        $image = $request->file('cover_image');
        
        $name_cover = time() . $image->getClientOriginalName();
        $image->storeAs('public/cover_image', $name_cover);
        $simpan = new Book();
        $simpan->title = $request->title;
        $simpan->category = $request->category;
        $simpan->author = $request->author;
        $simpan->description = $request->description;
        $simpan->cover_image = $name_cover;
        $simpan->published_at = $request->published_at;
        $simpan->save();

        if($simpan){
            return redirect()->route('admin.books.index')->with('message', [
                'success' => true,
                'message' => 'Buku berhasil ditambahkan'
            ]);
        }else{
            return redirect()->route('admin.books.index')->with('message', [
                'success' => false,
                'message' => 'Buku gagal ditambahkan'
            ]);
        }
    }

    public function show($id)
    {
        $data = Book::find($id);
        return view('admin.books.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Book::find($id);
        return view('admin.books.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required', 
            'author' => 'required',
            'description' => 'required',
            'published_at' => 'required',
        ]);

        $simpan = Book::find($id);
        $simpan->title = $request->title;
        $simpan->category = $request->category;
        $simpan->author = $request->author;
        $simpan->description = $request->description;
        $simpan->cover_image = $request->cover_image;
        $simpan->published_at = $request->published_at;
        
        // cek ada cover image tidak
        if($request->hasFile('cover_image')){
            // jika ada file lama dihapus
            if($simpan->cover_image){
                Storage::delete('public/cover_image/'.$simpan->cover_image);
            }
            $image = $request->file('cover_image');
            $name_cover = time() . $image->getClientOriginalName();
            $image->storeAs('public/cover_image', $name_cover);
            $simpan->cover_image = $name_cover;
        }
        $simpan->save();

        if($simpan){
            return redirect()->route('admin.books.index')->with('message', [
                'success' => true,
                'message' => 'Buku berhasil diubah'
            ]);
        }else{
            return redirect()->route('admin.books.index')->with('message', [
                'success' => false,
                'message' => 'Buku gagal diubah'
            ]);
        }
    }

    public function destroy($id)
    {
        $data = Book::find($id);
        $data->is_active = 0;

        if($data){
            return redirect()->route('admin.books.index')->with('message', [
                'success' => true,
                'message' => 'Buku berhasil dihapus'
            ]);
        }else{
            return redirect()->route('admin.books.index')->with('message', [
                'success' => false,
                'message' => 'Buku gagal dihapus'
            ]);
        }
    }


}
