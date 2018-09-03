@extends('layouts.admin')

@section('content')

<!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="coorddashboard.php">Home</a></li>
                    <li class="active">Add Student</li>
                </ul>
                <!-- END BREADCRUMB -->

                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Add Student</h2>
                </div>
                <!-- END PAGE TITLE -->

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <!-- START RESPONSIVE TABLES -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">Add Student</h3>
                                </div>

                                <div class="panel-body">

                                  <form action="{{ action('StudentController@store') }}" method="post" accept-charset="utf-8" class="form-horizontal" enctype="multipart/form-data">
                                      {{ csrf_field() }}

                                      <div class='form-group'>
                                         <label  class="col-md-3 col-xs-12 control-label" for="fullname">Fullname:</label>
                                         <div class="col-md-9 col-xs-12">
                                           <input type="text" id="fullname" name="fullname" class="form-control"/>
                                         </div>
                                      </div>

                                      <div class='form-group'>
                                         <label  class="col-md-3 col-xs-12 control-label" for="id_number">Id Number:</label>
                                         <div class="col-md-9 col-xs-12">
                                           <input type="text" id="id_number" name="id_number" class="form-control"/>
                                         </div>
                                      </div>

                                      <div class='form-group'>
                                         <label  class="col-md-3 col-xs-12 control-label" for="student_number">Student Number:</label>
                                         <div class="col-md-9 col-xs-12">
                                           <input type="text" id="student_number" name="student_number" class="form-control"/>
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
                                        <label  class="col-md-3 col-xs-12 control-label" for="gender">Gender:</label>
                                        <div class="col-md-9 col-xs-12">
                                          <select name="gender" id="gender" class="form-control select">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class='form-group'>
                                        <label  class="col-md-3 col-xs-12 control-label" for="race">Race:</label>
                                        <div class="col-md-9 col-xs-12">
                                          <select name="race" id="race" class="form-control select">
                                            <option value="African">African</option>
                                            <option value="White">White</option>
                                            <option value="Asian">Asian</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="col-md-3 col-xs-12 control-label">Registration Date</label>
                                          <div class="col-md-9 col-xs-12">
                                              <div class="input-group">
                                                  <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                  <input type="date" class="form-control datepicker" id="registration_date" name="registration_date" value="">
                                              </div>
                                          </div>
                                      </div>

                                      <?php $depts = App\Department::all() ?>

                                      <div class="form-group">
                                          <label class="col-md-3 col-xs-12 control-label">Subject</label>
                                          <div class="col-md-9 col-xs-12">
                                            <select data-placeholder="Please Select Subject" class="form-control select" name="subject_id">
                                                    <option value="0"></option>
                                                    @foreach( $depts as $dept)
                                                        <optgroup label="{{$dept->department}}">
                                                            @foreach($dept->courses()->get() as $course)
                                                                <optgroup label="{{$course->course}}">
                                                                    @foreach($course->subjects()->get() as $subject)
                                                                      <option value="{{$subject->id}}">{{$subject->subject}} - {{$subject->year}}</option>
                                                                    @endforeach
                                                                </optgroup>
                                                            @endforeach
                                                        </optgroup>
                                                     @endforeach
                                             </select>
                                          </div>
                                      </div>

                                      <?php $fundings = App\Funding::all() ?>

                                      <div class="form-group">
                                          <label class="col-md-3 col-xs-12 control-label">Funding</label>
                                          <div class="col-md-9 col-xs-12">
                                            <select data-placeholder="Please Select Funding" class="form-control select" name="funding_id">
                                                    <option value="0">Please Select Funding</option>
                                                    @foreach( $fundings as $fund)
                                                        <option value="{{$fund->id}}">{{$fund->name}} - {{$fund->funder}}</option>
                                                    @endforeach
                                             </select>
                                          </div>
                                      </div>


                                      <div class="form-group push-up-30">
                                          <div class="col-md-6">

                                          </div>
                                          <div class="col-md-6">
                                              <button type="submit" class="btn btn-danger btn-block">Add Student</button>
                                              <input type="hidden" name="task" value="register">
                                          </div>
                                      </div>

                                  </form>

                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
@stop
