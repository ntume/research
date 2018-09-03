@extends('layouts.admin')

@section('content')

<!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="coorddashboard.php">Home</a></li>
                    <li class="active">Supervisors </li>
                </ul>
                <!-- END BREADCRUMB -->
                @if(Session::has('msg'))
                    <p class = "bg-info"><b>{{session('msg')}}</b></p>
                @endif
                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Supervisors</h2>

                    <a href="{{route('admin.supervisors.create')}}" type="button" class="btn btn-primary pull-right">Add Supervisors</a>
                </div>
                <!-- END PAGE TITLE -->

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <!-- START RESPONSIVE TABLES -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">List of Supervisors</h3>

                                </div>

                                <div class="panel-body panel-body-table">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fullname</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Location</th>
                                                    <th>Qualification</th>
                                                    <th width="120">actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php $number = 1;?>
                                                @foreach($supervisors as $supervisor)
                                                  <tr>
                                                    <td>{{$number}}</td>
                                                    <td>{{$supervisor->fullname}}</td>
                                                    <td>{{$supervisor->email}}</td>
                                                    <td>{{$supervisor->contact}}</td>
                                                    <td>{{$supervisor->locale}}</td>
                                                    <td>{{$supervisor->qualification}}</td>
                                                    <td>
                                                      <button class="btn btn-primary btn-rounded btn-condensed btn-sm" data-toggle="modal" data-target="#myModalEdit_{{$number}}"><span class="fa fa-pencil"></span></button>

                                                            <div class="modal" id="myModalEdit_{{$number}}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                            <h4 class="modal-title" id="defModalHead">Edit Supervisor: {{$supervisor->fullname}}</h4>
                                                                        </div>
                                                                        <form action="{{ action('SupervisorController@update',$supervisor->id) }}" class="form-horizontal" method="POST">
                                                                          {{ csrf_field() }}
                                                                          {{ method_field('PUT') }}
                                                                        <div class="modal-body">

                                                                            <div class="form-group">
                                                                                <label class="col-md-3 col-xs-12 control-label">Fullname</label>
                                                                                <div class="col-md-6 col-xs-12">
                                                                                    <input type="text" class="form-control" name="fullname" value="{{$supervisor->fullname}}"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 col-xs-12 control-label">Email</label>
                                                                                <div class="col-md-6 col-xs-12">
                                                                                    <input type="email" class="form-control" name="email" value="{{$supervisor->email}}"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 col-xs-12 control-label">Contact</label>
                                                                                <div class="col-md-6 col-xs-12">
                                                                                    <input type="text" class="form-control" name="contact" value="{{$supervisor->contact}}"/>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label class="col-md-3 col-xs-12 control-label">Location</label>
                                                                                <div class="col-md-6 col-xs-12">
                                                                                    <select class="form-control select" name="locale">
                                                                                        @if($supervisor->locale == 'External')
                                                                                            <option value="External" selected="true">External</option>
                                                                                            <option value="Internal">Internal</option>
                                                                                        @else
                                                                                            <option value="External">External</option>
                                                                                            <option value="Internal" selected="true">Internal</option>
                                                                                        @endif
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label class="col-md-3 col-xs-12 control-label">Qualification</label>
                                                                                <div class="col-md-6 col-xs-12">
                                                                                    <input type="text" class="form-control" name="qualification" value="{{$supervisor->qualification}}"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                                                                            <button class="btn btn-danger btn-lg pull-right" type="submit">Edit Supervisor</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                          <button type="button" class="btn btn-danger btn-rounded btn-sm btn-condensed mb-control" data-box="#myModalDelete_{{$number}}"><span class="fa fa-times"></span></button>

                                                          <div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="myModalDelete_{{$number}}">
                                                              <div class="mb-container">
                                                                  <form action="{{ action('SupervisorController@destroy',$supervisor->id) }}"  method="POST">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                  <div class="mb-middle">
                                                                      <div class="mb-title"><span class="fa fa-times"></span> Delete Supervisor: {{$supervisor->fullname}}</div>
                                                                      <div class="mb-content">
                                                                          <p>Are you sure you want to delete this Supervisor from the database? This will remove all the links he/she has from all students</p>
                                                                      </div>
                                                                      <div class="mb-footer">
                                                                          <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                                                                          <button class="btn btn-danger btn-lg pull-right" type="submit">Delete Supervisor</button>
                                                                      </div>
                                                                  </div>
                                                                  </form>
                                                              </div>
                                                          </div>

                                                        </td>
                                                  </tr>
                                                  <?php $number++;?>
                                                @endforeach
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
