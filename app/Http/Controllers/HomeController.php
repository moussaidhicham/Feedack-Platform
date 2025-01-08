<?php

namespace App\Http\Controllers;

use App\Models\Course; // Importer la classe Course
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
    // public function index()
    // {
    //     $courses = Course::orderBy('created_at', 'desc')->get();
    //     return view('home', compact('courses')); // Passer les cours à la vue
    // }
    public function index(Request $request)
{
    return redirect()->route('courses.index', $request->all());

}

}
