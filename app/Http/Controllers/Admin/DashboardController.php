<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\FormSuggestion;
use App\Models\Notification;
use App\Models\ProductStock;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    //message
    public function message()
    {
        $datas = FormSuggestion::orderBy('created_at', 'desc')->get();
        return view('admin.message', compact('datas'));
    }

}
