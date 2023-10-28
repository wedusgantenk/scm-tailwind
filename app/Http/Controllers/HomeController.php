<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Video;
use App\Models\Event;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $event = Event::limit(4)->orderBy('created_at', 'desc')->get();
        $village = Village::all();
        return view('home.index', compact('village','event'));
    }

    public function event()
    {
        $data = Event::all();
        $village = Village::all();
        return view('home.event', compact('village','data'));
    }
    public function event_detail($slug)
    {
        $data = Event::all()->where('slug', $slug)->first();
        $village = Village::all();
        return view('home.event_detail', compact('village','data'));
    }

    public function event_desa($village_id)
    {
        $data = Event::all()->where('village_id', $village_id);
        $village = Village::all();
        return view('home.event', compact('village','data'));
    }

    public function about()
    {        
        $village = Village::all();
        return view('home.about', compact('village'));
    }
}
