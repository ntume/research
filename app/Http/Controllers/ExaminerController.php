<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExaminerRequest;
use App\Examiner;
use Illuminate\Support\Facades\Session;

class ExaminerController extends Controller
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
      $examiners = Examiner::all();
      return view('admin.examiners.index',compact('examiners'));

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
      return view('admin.examiners.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ExaminerRequest $request)
  {
      //
      Examiner::create($request->all());
      Session::flash('msg','Examiner has been added');
      $examiners = Examiner::all();
      return view('admin.examiners.index',compact('examiners'));
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
      $examiner = Examiner::find($id);
      $examiner->update($request->all());
      Session::flash('msg','Examiner has been updated');
      $examiners = Examiner::all();
      return view('admin.examiners.index',compact('examiners'));
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
      $examiner = Examiner::find($id);
      $examiner->delete();
      Session::flash('msg','Examiner has been removed');
      $examiners = Examiner::all();
      return view('admin.examiners.index',compact('examiners'));
  }
}
