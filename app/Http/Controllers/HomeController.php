<?php

namespace App\Http\Controllers;

use App\Models\Beverage;
use App\Models\Category;
use Illuminate\Http\Request;

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
        // return view('index');

        $categories = Category::latest()->take(3)->get();
        $beverages = Beverage::all();
        $specialItems = Beverage::where('special', 'yes')->get();
        // return view('index', ['specialItems' => $specialItems]);
        return view('index', ['categories' => $categories, 'beverages' => $beverages, 'specialItems' => $specialItems]);
    }
}
