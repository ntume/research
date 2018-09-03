<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;

class AdminController extends Controller
{
    //

    public function __construct(){
      $this->middleware('IsAdmin');
    }

    public function index(){
      return "you are an administrator coz you can see this page";
    }
}
