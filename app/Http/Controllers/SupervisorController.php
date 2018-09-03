<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supervisors;
use App\Http\Requests\SupervisorsRequest;
use Illuminate\Support\Facades\Session;

class SupervisorController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function __construct()
   {
       $this->middleware('auth');
   }

  public function index()
  {
      //
      $supervisors = Supervisors::all();
      return view('admin.supervisors.index',compact('supervisors'));

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
      return view('admin.supervisors.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(SupervisorsRequest $request)
  {
      //
      Supervisors::create($request->all());
      Session::flash('msg','Supervisor has been added');
      $supervisors = Supervisors::all();
      return view('admin.supervisors.index',compact('supervisors'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
      $supervisor = Supervisors::find($id);
      $supervisor->update($request->all());
      Session::flash('msg','Supervsior has been updated');
      $supervisors = Supervisors::all();
      return view('admin.supervisors.index',compact('supervisors'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
      $supervisor = Supervisors::find($id);
      $supervisor->delete();
      Session::flash('msg','Supervisor has been removed');
      $supervisors = Supervisors::all();
      return view('admin.supervisors.index',compact('supervisors'));
  }
}
