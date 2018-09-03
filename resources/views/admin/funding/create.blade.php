@extends('layouts.admin')

@section('content')

<!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('admin.funding.index')}}">List of Funding</a></li>
                    <li class="active">Add Funding</li>
                </ul>
                <!-- END BREADCRUMB -->

                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Add Funding</h2>
                </div>
                <!-- END PAGE TITLE -->

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <!-- START RESPONSIVE TABLES -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">Add Funding</h3>
                                </div>

                                <div class="panel-body">

                                  <form action="{{ action('FundingController@store') }}" method="post" accept-charset="utf-8" class="form-horizontal">
                                      {{ csrf_field() }}

                                      <div class='form-group'>
                                         <label  class="col-md-3 col-xs-12 control-label" for="fullname">Name:</label>
                                         <div class="col-md-9 col-xs-12">
                                           <input type="text" id="name" name="name" class="form-control"/>
                                         </div>
                                      </div>

                                      <div class='form-group'>
                                        <label  class="col-md-3 col-xs-12 control-label" for="contact">Description:</label>
                                        <div class="col-md-9 col-xs-12">
                                          <textarea id="description" name="description" class="form-control"></textarea>
                                        </div>
                                      </div>

                                      <div class='form-group'>
                                        <label  class="col-md-3 col-xs-12 control-label" for="email">Funder:</label>
                                        <div class="col-md-9 col-xs-12">
                                          <input type="text" id="funder" name="funder" class="form-control" />
                                        </div>
                                      </div>

                                      <div class="form-group push-up-30">
                                          <div class="col-md-6">

                                          </div>
                                          <div class="col-md-6">
                                              <button type="submit" class="btn btn-danger btn-block">Add Funding</button>
                                          </div>
                                      </div>

                                  </form>

                                </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    @include('includes.form-error')
@stop
