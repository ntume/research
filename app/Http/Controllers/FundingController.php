<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FundingRequest;
use App\Funding;
use Illuminate\Support\Facades\Session;

class FundingController extends Controller
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
      $fundings = Funding::all();
      return view('admin.funding.index',compact('fundings'));

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('admin.funding.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(FundingRequest $request)
  {
      Funding::create($request->all());
      Session::flash('msg','Funding has been added');
      $fundings = Funding::all();
      return view('admin.funding.index',compact('fundings'));
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
      $funding = Funding::find($id);
      $funding->update($request->all());
      Session::flash('msg','Funding has been updated');
      $fundings = Funding::all();
      return view('admin.funding.index',compact('fundings'));
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
      $funding = Funding::find($id);
      $funding->delete();
      Session::flash('msg','Funding has been removed');
      $fundings = Funding::all();
      return view('admin.funding.index',compact('fundings'));
  }
}
