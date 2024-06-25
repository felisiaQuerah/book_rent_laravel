<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Rent;
use App\Models\Setting;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RentController extends Controller
{
    public function index()
    {
        $data  = Rent::all();
        return view('admin.rent.index', compact('data'));
    }


}
