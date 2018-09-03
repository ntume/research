@extends('layouts.admin')

@section('content')

<!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('admin.examiners.index')}}">List of Examiners</a></li>
                    <li class="active">Add Examiner</li>
                </ul>
                <!-- END BREADCRUMB -->

                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Add Examiner</h2>
                </div>
                <!-- END PAGE TITLE -->

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <!-- START RESPONSIVE TABLES -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">Add Examiner</h3>
                                </div>

                                <div class="panel-body">

                                  <form action="{{ action('ExaminerController@store') }}" method="post" accept-charset="utf-8" class="form-horizontal">
                                      {{ csrf_field() }}

                                      <div class='form-group'>
                                         <label  class="col-md-3 col-xs-12 control-label" for="fullname">Fullname:</label>
                                         <div class="col-md-9 col-xs-12">
                                           <input type="text" id="fullname" name="fullname" class="form-control"/>
                                         </div>
                                      </div>

                                      <div class='form-group'>
                                        <label  class="col-md-3 col-xs-12 control-label" for="contact">Contact:</label>
                                        <div class="col-md-9 col-xs-12">
                                          <input type="text" id="contact" name="contact" class="form-control" />
                                        </div>
                                      </div>

                                      <div class='form-group'>
                                        <label  class="col-md-3 col-xs-12 control-label" for="email">Email:</label>
                                        <div class="col-md-9 col-xs-12">
                                          <input type="email" id="email" name="email" class="form-control" />
                                        </div>
                                      </div>

                                      <div class='form-group'>
                                         <label  class="col-md-3 col-xs-12 control-label" for="qualification">Qualification:</label>
                                         <div class="col-md-9 col-xs-12">
                                           <input type="text" id="qualification" name="qualification" class="form-control"/>
                                         </div>
                                      </div>

                                      <div class='form-group'>
                                        <label  class="col-md-3 col-xs-12 control-label" for="gender">Location:</label>
                                        <div class="col-md-9 col-xs-12">
                                          <textarea name="location" class="form-control"></textarea>
                                        </div>
                                      </div>

                                      <div class="form-group push-up-30">
                                          <div class="col-md-6">

                                          </div>
                                          <div class="col-md-6">
                                              <button type="submit" class="btn btn-danger btn-block">Add Examiner</button>
                                              <input type="hidden" name="task" value="register">
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
