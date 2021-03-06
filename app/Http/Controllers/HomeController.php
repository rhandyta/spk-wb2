<?php

namespace App\Http\Controllers;

use App\Models\Pilihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $voted = Pilihan::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.dashboard', compact('voted'));
    }
}
