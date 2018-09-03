@extends('layouts.admin')

@section('content')

<!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="coorddashboard.php">Home</a></li>
                    <li class="active">Available Funding </li>
                </ul>
                <!-- END BREADCRUMB -->
                @if(Session::has('msg'))
                    <p class = "bg-info"><b>{{session('msg')}}</b></p>
                @endif
                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Funding</h2>

                    <a href="{{route('admin.funding.create')}}" type="button" class="btn btn-primary pull-right">Add Funding</a>
                </div>
                <!-- END PAGE TITLE -->

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <!-- START RESPONSIVE TABLES -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">List of Funding</h3>

                                </div>

                                <div class="panel-body panel-body-table">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Funder</th>
                                                    <th width="120">actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php $number = 1;?>
                                                @foreach($fundings as $fund)
                                                  <tr>
                                                    <td>{{$number}}</td>
                                                    <td>{{$fund->name}}</td>
                                                    <td>{{$fund->description}}</td>
                                                    <td>{{$fund->funder}}</td>
                                                    <td>
                                                      <button class="btn btn-primary btn-rounded btn-condensed btn-sm" data-toggle="modal" data-target="#myModalEdit_{{$number}}"><span class="fa fa-pencil"></span></button>

                                                            <div class="modal" id="myModalEdit_{{$number}}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                            <h4 class="modal-title" id="defModalHead">Edit Funding: {{$fund->name}}</h4>
                                                                        </div>
                                                                        <form action="{{ action('FundingController@update',$fund->id) }}" class="form-horizontal" method="POST">
                                                                          {{ csrf_field() }}
                                                                          {{ method_field('PUT') }}
                                                                        <div class="modal-body">

                                                                            <div class="form-group">
                                                                                <label class="col-md-3 col-xs-12 control-label">Name</label>
                                                                                <div class="col-md-6 col-xs-12">
                                                                                    <input type="text" class="form-control" name="name" value="{{$fund->name}}"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 col-xs-12 control-label">Description</label>
                                                                                <div class="col-md-6 col-xs-12">
                                                                                    <textarea class="form-control" name="description">{{$fund->description}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 col-xs-12 control-label">Funder</label>
                                                                                <div class="col-md-6 col-xs-12">
                                                                                    <input type="text" class="form-control" name="funder" value="{{$fund->funder}}"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                                                                            <button class="btn btn-danger btn-lg pull-right" type="submit">Edit Funding</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                          <button type="button" class="btn btn-danger btn-rounded btn-sm btn-condensed mb-control" data-box="#myModalDelete_{{$number}}"><span class="fa fa-times"></span></button>

                                                          <div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="myModalDelete_{{$number}}">
                                                              <div class="mb-container">
                                                                  <form action="{{ action('FundingController@destroy',$fund->id) }}"  method="POST">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                  <div class="mb-middle">
                                                                      <div class="mb-title"><span class="fa fa-times"></span> Delete Funding: {{$fund->name}}</div>
                                                                      <div class="mb-content">
                                                                          <p>Are you sure you want to delete this Funding from the database? This will remove all the links the fund has from all students</p>
                                                                      </div>
                                                                      <div class="mb-footer">
                                                                          <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                                                                          <button class="btn btn-danger btn-lg pull-right" type="submit">Delete Funding</button>
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
