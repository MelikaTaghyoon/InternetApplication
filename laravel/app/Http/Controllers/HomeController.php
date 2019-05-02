<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Adoption;

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
     * Show the application adoptions if admin.
     * Show the animals if public user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Gate::allows('displayall')){
            $adoptions = Adoption::where('status','pending')->paginate(6);
            return view('home', compact('adoptions'));
        }
        return redirect('animals');
    }
}
