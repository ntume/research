@extends('layouts.admin')

@section('content')

<!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="coorddashboard.php">Home</a></li>
                    <li class="active">{{$studinfo['subject']}} - {{$studinfo['subject_code']}} - {{$studinfo['year']}} </li>
                </ul>
                <!-- END BREADCRUMB -->
                @if(Session::has('deleted_student'))
                    <p class = "bg-info"><b>{{session('deleted_student')}}</b></p>
                @endif
                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Students</h2>

                    <a href="#" type="button" class="btn btn-primary pull-right">Add Student</a>
                    <a href="#" type="button" class="btn btn-warning pull-right" target="_blank" style="target-new: tab;">Student Messenger</a>
                    <a href="#" type="button" class="btn btn-info pull-right" target="_blank" style="target-new: tab;">Subject Mentors</a>
                </div>
                <!-- END PAGE TITLE -->


                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <!-- START RESPONSIVE TABLES -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">List of Students: {{$studinfo['subject']}} - {{$studinfo['subject_code']}} - {{$studinfo['year']}}</h3>

                                </div>

                                <div class="panel-body panel-body-table">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Student Number</th>
                                                    <th>Fullname</th>
                                                    <th>ID Number</th>
                                                    <th>Contact Details</th>
                                                    <th>Registration Date</th>
                                                    <th>Funding</th>
                                                    <th>Submitted</th>
                                                    <th>Completed</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for($x=0;$x<$studinfo['loop'];$x++)
                                                <tr>
                                                  <td>{{$studinfo[$x]['number']}}</td>
                                                  <td>{{$studinfo[$x]['student_number']}}</td>
                                                  <td>{{$studinfo[$x]['fullname']}}</td>
                                                  <td>{{$studinfo[$x]['id_number']}}</td>
                                                  <td>{{$studinfo[$x]['email']}}<br>{{$studinfo[$x]['contact']}}</td>
                                                  <td>{{$studinfo[$x]['registration_date']}}</td>
                                                  <td>{{$studinfo[$x]['fund']}}</td>
                                                  <td>
                                                    @if($studinfo[$x]['submitted'] == 'Yes')
                                                      Submitted: <span class="fa fa-check"></span>
                                                      Date: {{$studinfo[$x]['submit_date']}}
                                                    @else
                                                      Submitted: <span class="fa fa-times"></span>
                                                    @endif
                                                    <br><br><button class="btn btn-primary btn-rounded btn-condensed btn-sm" data-toggle="modal" data-target="#myModalsubmit_{{$studinfo[$x]['number']}}"><span class="fa fa-arrow-circle-down"></span></button>

                                                                <div class="modal" id="myModalsubmit_{{$studinfo[$x]['number']}}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                                <h4 class="modal-title" id="defModalHead">Submission</h4>
                                                                            </div>
                                                                            <form action="students.php" class="form-horizontal"  method="POST">
                                                                            <div class="modal-body">

                                                                              <div class="form-group">
                                                                                  <label class="col-md-3 col-xs-12 control-label">Submission Date</label>
                                                                                  <div class="col-md-6 col-xs-12">
                                                                                      <div class="input-group">
                                                                                          <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                                                          <input type="text" class="form-control datepicker" name="datesubmit"  value="">
                                                                                      </div>
                                                                                  </div>
                                                                              </div>

                                                                                <div class="form-group">
                                                                                    <label class="col-md-3 col-xs-12 control-label">Submitted</label>
                                                                                    <div class="col-md-6 col-xs-12">
                                                                                        <select class="form-control" name="submitted">
                                                                                          @if($studinfo[$x]['submitted'] == 'Yes')
                                                                                              <option value="Yes" selected="true">Yes</option>
                                                                                              <option value="No">No</option>
                                                                                          @else
                                                                                              <option value="Yes">Yes</option>
                                                                                              <option value="No" selected="true">No</option>
                                                                                          @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                                                                                <button class="btn btn-danger btn-lg pull-right" type="submit">Add Submission</button>
                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                  </td>
                                                  <td>
                                                    @if($studinfo[$x]['completed'] == 'Yes')
                                                      <b>Completed:</b> <span class="fa fa-check"></span><br>
                                                      <b>Grade:</b>{{$studinfo[$x]['average_grade']}}<br>

                                                    @else
                                                      <b>Completed:</b> <span class="fa fa-times"></span><br>
                                                    @endif

                                                    <br><button class="btn btn-primary btn-rounded btn-condensed btn-sm" data-toggle="modal" data-target="#myModalComplete_{{$studinfo[$x]['number']}}"><span class="fa fa-arrow-circle-down"></span></button>

                                                                <div class="modal" id="myModalComplete_{{$studinfo[$x]['number']}}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                                <h4 class="modal-title" id="defModalHead">Add Grade for: {{$studinfo[$x]['fullname']}}</h4>
                                                                            </div>
                                                                            <form action="students.php" class="form-horizontal"  method="POST">
                                                                            <div class="modal-body">

                                                                                <div class="form-group">
                                                                                    <label class="col-md-3 col-xs-12 control-label">Grade</label>
                                                                                    <div class="col-md-6 col-xs-12">
                                                                                        <input type="text" class="form-control" name="average_grade" value="{{$studinfo[$x]['average_grade']}}"/>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label class="col-md-3 col-xs-12 control-label">Completed</label>
                                                                                    <div class="col-md-6 col-xs-12">

                                                                                            @if($studinfo[$x]['completed'] == 'Yes')
                                                                                              <select class="form-control" name="completed">
                                                                                                  <option value="Yes" selected="true">Yes</option>
                                                                                                  <option value="No">No</option>
                                                                                              </select>
                                                                                            @else
                                                                                              <select class="form-control select" name="completed">
                                                                                                  <option value="Yes">Yes</option>
                                                                                                  <option value="No" selected="true">No</option>
                                                                                              </select>
                                                                                            @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                                                                                <button class="btn btn-danger btn-lg pull-right" type="submit">Add Grade</button>
                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                  </td>
                                                  <td>
                                                    <a href="{{ route('admin.students.show',$studinfo[$x]['id']) }}" class="btn btn-primary btn-rounded btn-condensed btn-sm"><span class="fa fa-pencil"></span></a>
                                                    <button type="button" class="btn btn-danger btn-rounded btn-sm btn-condensed mb-control" data-box="#myModalDelete_{{$studinfo[$x]['number']}}"><span class="fa fa-times"></span></button>

                                                    <div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="myModalDelete_{{$studinfo[$x]['number']}}">
                                                        <div class="mb-container">
                                                            <form action="{{ action('StudentController@destroy',$studinfo[$x]['id']) }}"  method="POST">
                                                              {{ csrf_field() }}
                                                              {{ method_field('DELETE') }}
                                                            <div class="mb-middle">
                                                                <div class="mb-title"><span class="fa fa-times"></span> Remove Student: {{$studinfo[$x]['fullname']}}</div>
                                                                <div class="mb-content">
                                                                    <p>Are you sure you want to remove this student from the database?</p>
                                                                </div>
                                                                <div class="mb-footer">
                                                                    <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                                                                    <button class="btn btn-danger btn-lg pull-right" type="submit">Delete Student</button>
                                                                    <input type="hidden" name="subject_id" value="{{$studinfo['subject_id']}}">
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                  </td>
                                                </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- END RESPONSIVE TABLES -->

                <!-- END PAGE CONTENT WRAPPER -->
                </div>

@stop
