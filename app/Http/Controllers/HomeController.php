<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$request->session->put((['edwin'=>'Instructor']));//one way
        //session(['peter'=>'stduent']);//another way, easier you do not need request
        //$request->session()->forget('peter');//delete one session
        //$request->session->flush();//delete all sessions
        //$request->session()->flash('message','Post has been accepted');//sending a message to user
        $user = Auth::user();
        return view('admin.index',compact('user'));
    }
}
