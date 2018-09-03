@extends('layouts.admin')

@section('content')

        <!-- START BREADCRUMB -->
        <ul class="breadcrumb">
            <li><a href="coorddashboard.php">Home</a></li>
            <li class="active">View Student</li>
        </ul>
        <!-- END BREADCRUMB -->
        @if(Session::has('msg'))
            <p class = "bg-info"><b>{{session('msg')}}</b></p>
        @endif

        <div class="page-tabs">
            <a href="#step-1" class="active">Student<small> Information</small></a>
            <a href="#step-2">Supervisors<small> Information</small></a>
            <a href="#step-3">Submissions</a>
            <a href="#step-4">Examiners</a>
            <a href="#step-5">Publications</a>
            <a href="#step-6">Timeline</a>
        </div>

        <div class="page-content-wrap page-tabs-item active" id="step-1">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                                <h3>Student Information</h3>

                                <form action="{{ action('StudentController@update',$studsubj->id) }}" method="post" accept-charset="utf-8" class="form-horizontal" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <div class='form-group'>
                                       <label  class="col-md-3 col-xs-12 control-label" for="fullname">Fullname:</label>
                                       <div class="col-md-9 col-xs-12">
                                         <input type="text" id="fullname" name="fullname" class="form-control" value="{{$studsubj->student->fullname}}"/>
                                       </div>
                                    </div>

                                    <div class='form-group'>
                                       <label  class="col-md-3 col-xs-12 control-label" for="id_number">Id Number:</label>
                                       <div class="col-md-9 col-xs-12">
                                         <input type="text" id="id_number" name="id_number" class="form-control" value="{{$studsubj->student->id_number}}"/>
                                       </div>
                                    </div>

                                    <div class='form-group'>
                                       <label  class="col-md-3 col-xs-12 control-label" for="student_number">Student Number:</label>
                                       <div class="col-md-9 col-xs-12">
                                         <input type="text" id="student_number" name="student_number" class="form-control" value="{{$studsubj->student->student_number}}"/>
                                       </div>
                                    </div>

                                    <div class='form-group'>
                                      <label  class="col-md-3 col-xs-12 control-label" for="contact">Contact:</label>
                                      <div class="col-md-9 col-xs-12">
                                        <input type="text" name="contact" class="form-control" value="{{$studsubj->student->contact}}"/>
                                      </div>
                                    </div>

                                    <div class='form-group'>
                                      <label  class="col-md-3 col-xs-12 control-label" for="email">Email:</label>
                                      <div class="col-md-9 col-xs-12">
                                        <input type="email" name="email" class="form-control" value="{{$studsubj->student->email}}"/>
                                      </div>
                                    </div>

                                    <div class='form-group'>
                                      <label  class="col-md-3 col-xs-12 control-label" for="gender">Gender:</label>
                                      <div class="col-md-9 col-xs-12">
                                        <select name="gender" id="gender" class="form-control select">
                                          @if($studsubj->student->gender == "Male")
                                            <option value="Male" selected>Male</option>
                                            <option value="Female">Female</option>
                                          @elseif($studsubj->student->gender == "Female")
                                            <option value="Male">Male</option>
                                            <option value="Female" selected>Female</option>
                                          @endif
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
                                                <input type="date" class="form-control datepicker" id="registration_date" name="registration_date" value="{{$studsubj->registration_date}}">
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
                                                                    @if($subject->id == $studsubj->subject_id)
                                                                      <option value="{{$subject->id}}" selected>{{$subject->subject}} - {{$subject->year}}</option>
                                                                    @else
                                                                      <option value="{{$subject->id}}">{{$subject->subject}} - {{$subject->year}}</option>
                                                                    @endif
                                                                  @endforeach
                                                              </optgroup>
                                                          @endforeach
                                                      </optgroup>
                                                   @endforeach
                                           </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Funding</label>
                                        <div class="col-md-9 col-xs-12">
                                          <select data-placeholder="Please Select Funding" class="form-control select" name="funding_id">
                                                  <option value="0">Please Select Funding</option>
                                                  @foreach($fundings as $fund)
                                                      @if($studsubj->funding_id == $fund->id)
                                                          <option value="{{$fund->id}}" selected>{{$fund->name}} - {{$fund->funder}}</option>
                                                      @else
                                                          <option value="{{$fund->id}}">{{$fund->name}} - {{$fund->funder}}</option>
                                                      @endif
                                                  @endforeach
                                           </select>
                                        </div>
                                    </div>

                                    <div class="form-group push-up-30">
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary btn-block">Edit Student Information</button>
                                        </div>
                                    </div>

                                </form>


                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="page-content-wrap page-tabs-item" id="step-2">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                           <h3>Supervisor Information</h3>

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
                                           <th>Designation</th>
                                           <th width="120">actions</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                     <?php $number = 1;?>
                                       @forelse($studsubj->supervisors as $supervisor)
                                       <?php $sup = App\Supervisors::find($supervisor->supervisor_id)?>
                                         <tr>
                                           <td>{{$number}}</td>
                                           <td>{{$sup->fullname}}</td>
                                           <td>{{$sup->email}}</td>
                                           <td>{{$sup->contact}}</td>
                                           <td>{{$sup->locale}}</td>
                                           <td>{{$sup->qualification}}</td>
                                           <td>{{$supervisor->designation}}</td>
                                           <td>
                                                 <button type="button" class="btn btn-danger btn-rounded btn-sm btn-condensed mb-control" data-box="#myModalDelete_{{$number}}"><span class="fa fa-times"></span></button>

                                                 <div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="myModalDelete_{{$number}}">
                                                     <div class="mb-container">
                                                         <form action="{{ action('StudentController@removesupervisor',$supervisor->id) }}"  method="POST">
                                                           {{ csrf_field() }}
                                                           {{ method_field('DELETE') }}
                                                         <div class="mb-middle">
                                                             <div class="mb-title"><span class="fa fa-times"></span> Remove Supervisor: {{$supervisor->fullname}}</div>
                                                             <div class="mb-content">
                                                                 <p>Are you sure you want to remove this Supervisor from the student?</p>
                                                             </div>
                                                             <div class="mb-footer">
                                                                 <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                                                                 <button class="btn btn-danger btn-lg pull-right" type="submit">Remove Supervisor</button>
                                                             </div>
                                                         </div>
                                                         </form>
                                                     </div>
                                                 </div>

                                               </td>
                                         </tr>
                                         <?php $number++;?>
                                         @empty
                                         <tr><td colspan="7">No Supervisors assigned yet</td></tr>
                                       @endforelse
                                   </tbody>
                               </table>
                           </div>


                        </div>
                    </div>
                </div>
            </div>
            <?php $check=1;?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                           <h3>Assign Supervisor To Student</h3>

                           <form action="{{ action('StudentController@assignsupervisor') }}" method="post" accept-charset="utf-8" class="form-horizontal">
                               {{ csrf_field() }}
                               {{ method_field('PUT') }}

                               <div class='form-group'>
                                 <label  class="col-md-3 col-xs-12 control-label" for="race">Supervisor:</label>
                                 <div class="col-md-9 col-xs-12">
                                   <select name="supervisor_id" id="supervisor_id" class="form-control select">
                                     <option selected>Choose Supervisor from List</option>
                                     @foreach($supervisors as $supervisor)
                                        @foreach($studsubj->supervisors as $supcheck)
                                          @if($supervisor->id == $supcheck->supervisor_id)
                                            <?php $check=0; ?>
                                          @endif
                                        @endforeach
                                        @if($check == 0)
                                          <option value="{{$supervisor->id}}" disabled>{{$supervisor->fullname}} - {{$supervisor->qualification}}</option>
                                        @else
                                          <option value="{{$supervisor->id}}">{{$supervisor->fullname}} - {{$supervisor->qualification}}</option>
                                        @endif
                                        <?php $check=1; ?>
                                    @endforeach
                                   </select>
                                 </div>
                               </div>

                               <div class='form-group'>
                                 <label  class="col-md-3 col-xs-12 control-label" for="race">Designation:</label>
                                 <div class="col-md-9 col-xs-12">
                                   <select name="designation" id="designation" class="form-control select">
                                        <option value="Main Supervisor">Main Supervisor</option>
                                        <option value="Co-Supervisor">Co-Supervisor</option>
                                   </select>
                                 </div>
                               </div>

                               <div class="form-group push-up-30">
                                   <div class="col-md-6">

                                   </div>
                                   <div class="col-md-6">
                                       <button type="submit" class="btn btn-info btn-block">Assign Supervisor</button>
                                       <input type="hidden" name="student_subject_id" value="{{$studsubj->id}}">
                                   </div>
                               </div>

                          </form>
                         </div>
                     </div>
                 </div>
             </div>


        </div>

        <div class="page-content-wrap page-tabs-item" id="step-3">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                               <h3>Submissions</h3>


                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-actions">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Comment</th>
                                                <th>Submission Date</th>
                                                <th>File</th>
                                                <th>Date added</th>
                                                <th width="120">actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php $number = 1;?>
                                            @forelse($studsubj->submissions as $submission)
                                            <?php $submission_type = App\SubmissionType::find($submission->submission_types_id)?>
                                              <tr>
                                                <td>{{$number}}</td>
                                                <td>{{$submission_type->name}}</td>
                                                <td>{{$submission_type->description}}</td>
                                                <td>{{$submission->description}}</td>
                                                <td>{{$submission->submission_date}}</td>
                                                <td>{{$submission->filepath}}</td>
                                                <td>{{$submission->created_at}}</td>
                                                <td>
                                                      <button type="button" class="btn btn-danger btn-rounded btn-sm btn-condensed mb-control" data-box="#myModalDeleteSubmission_{{$number}}"><span class="fa fa-times"></span></button>

                                                      <div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="myModalDeleteSubmission_{{$number}}">
                                                          <div class="mb-container">
                                                              <form action="{{ action('StudentController@removesubmission',$submission->id) }}"  method="POST">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                              <div class="mb-middle">
                                                                  <div class="mb-title"><span class="fa fa-times"></span> Remove Submission: {{$submission->name}}</div>
                                                                  <div class="mb-content">
                                                                      <p>Are you sure you want to remove this Submission from the student?</p>
                                                                  </div>
                                                                  <div class="mb-footer">
                                                                      <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                                                                      <button class="btn btn-danger btn-lg pull-right" type="submit">Remove Submission</button>
                                                                  </div>
                                                              </div>
                                                              </form>
                                                          </div>
                                                      </div>

                                                    </td>
                                              </tr>
                                              <?php $number++;?>
                                              @empty
                                              <tr><td colspan="7">No Submissions uploaded yet</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                           <h3>Add  Submission to Student File</h3>

                           <form action="{{ action('StudentController@addsubmission') }}" method="post" accept-charset="utf-8" class="form-horizontal" enctype="multipart/form-data">
                               {{ csrf_field() }}
                               {{ method_field('PUT') }}

                               <div class='form-group'>
                                 <label  class="col-md-3 col-xs-12 control-label" for="race">Document Type:</label>
                                 <div class="col-md-9 col-xs-12">
                                   <select name="submission_types_id" id="submission_types_id" class="form-control select">
                                     @foreach($submissiontypes as $type)
                                        <option value="{{$type->id}}">{{$type->name}} - [ {{$type->description}} ]</option>
                                    @endforeach
                                   </select>
                                 </div>
                               </div>

                               <div class='form-group'>
                                 <label  class="col-md-3 col-xs-12 control-label" for="description">Comment:</label>
                                 <div class="col-md-9 col-xs-12">
                                   <textarea class="form-control" name="description"></textarea>
                                 </div>
                               </div>

                               <div class="form-group">
                                   <label class="col-md-3 col-xs-12 control-label">Submission Date</label>
                                   <div class="col-md-9 col-xs-12">
                                       <div class="input-group">
                                           <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                           <input type="date" class="form-control datepicker" id="submission_date" name="submission_date" value="">
                                       </div>
                                   </div>
                               </div>

                               <div class='form-group'>
                                 <label  class="col-md-3 col-xs-12 control-label" for="description">Upload File:</label>
                                 <div class="col-md-9 col-xs-12">
                                   <input type="file" class="form-control" name="filepath">
                                 </div>
                               </div>

                               <div class="form-group push-up-30">
                                   <div class="col-md-6">

                                   </div>
                                   <div class="col-md-6">
                                       <button type="submit" class="btn btn-info btn-block">Add Submission</button>
                                       <input type="hidden" name="student_subject_id" value="{{$studsubj->id}}">
                                   </div>
                               </div>

                          </form>
                         </div>
                     </div>
                 </div>
             </div>

        </div>


        <div class="page-content-wrap page-tabs-item" id="step-4">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                           <h3>Examiner Information</h3>

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
                                       @forelse($studsubj->examiners as $examiner)
                                       <?php $ex = App\Examiner::find($examiner->examiner_id)?>
                                         <tr>
                                           <td>{{$number}}</td>
                                           <td>{{$ex->fullname}}</td>
                                           <td>{{$ex->email}}</td>
                                           <td>{{$ex->contact}}</td>
                                           <td>{{$ex->location}}</td>
                                           <td>{{$ex->qualification}}</td>
                                           <td>
                                                 <button type="button" class="btn btn-danger btn-rounded btn-sm btn-condensed mb-control" data-box="#myModalDeleteEx_{{$number}}"><span class="fa fa-times"></span></button>

                                                 <div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="myModalDeleteEx_{{$number}}">
                                                     <div class="mb-container">
                                                         <form action="{{ action('StudentController@removeexaminer',$examiner->id) }}"  method="POST">
                                                           {{ csrf_field() }}
                                                           {{ method_field('DELETE') }}
                                                         <div class="mb-middle">
                                                             <div class="mb-title"><span class="fa fa-times"></span> Remove Examiner: {{$ex->fullname}}</div>
                                                             <div class="mb-content">
                                                                 <p>Are you sure you want to remove this Examiner from the student?</p>
                                                             </div>
                                                             <div class="mb-footer">
                                                                 <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                                                                 <button class="btn btn-danger btn-lg pull-right" type="submit">Remove Examiner</button>
                                                             </div>
                                                         </div>
                                                         </form>
                                                     </div>
                                                 </div>
                                            </td>
                                         </tr>
                                         <?php $number++;?>
                                         @empty
                                         <tr><td colspan="7">No Examiner assigned yet</td></tr>
                                       @endforelse
                                   </tbody>
                               </table>
                           </div>


                        </div>
                    </div>
                </div>
            </div>
            <?php $check=1; ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                           <h3>Assign Examiner To Student</h3>

                           <form action="{{ action('StudentController@assignexaminer') }}" method="post" accept-charset="utf-8" class="form-horizontal">
                               {{ csrf_field() }}
                               {{ method_field('PUT') }}

                               <div class='form-group'>
                                 <label  class="col-md-3 col-xs-12 control-label" for="race">Examiner:</label>
                                 <div class="col-md-9 col-xs-12">
                                   <select name="examiner_id" id="examiner_id" class="form-control select">
                                     <option selected>Choose Examiner From List</option>
                                     @foreach($examiners as $examiner)
                                        @foreach($studsubj->examiners as $excheck)
                                          @if($excheck->examiner_id == $examiner->id)
                                            <?php $check = 0; ?>
                                          @endif
                                        @endforeach
                                        @if($check == 0)
                                          <option value="{{$examiner->id}}" disabled>{{$examiner->fullname}} - {{$examiner->qualification}}</option>
                                        @else
                                          <option value="{{$examiner->id}}">{{$examiner->fullname}} - {{$examiner->qualification}}</option>
                                        @endif
                                        <?php $check=1; ?>
                                    @endforeach
                                   </select>
                                 </div>
                               </div>

                               <div class="form-group push-up-30">
                                   <div class="col-md-6">

                                   </div>
                                   <div class="col-md-6">
                                       <button type="submit" class="btn btn-info btn-block">Assign Examiner</button>
                                       <input type="hidden" name="student_subject_id" value="{{$studsubj->id}}">
                                   </div>
                               </div>

                          </form>
                         </div>
                     </div>
                 </div>
             </div>


        </div>



        <div class="page-content-wrap page-tabs-item" id="step-5">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                               <h3>Publications</h3>


                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-actions">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Type</th>
                                                <th>Name</th>
                                                <th>Publication Date</th>
                                                <th>Date added</th>
                                                <th width="120">actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php $number = 1;?>
                                            @forelse($studsubj->publications as $publication)
                                              <tr>
                                                <td>{{$number}}</td>
                                                <td>{{$publication->title}}</td>
                                                <td>{{$publication->type}}</td>
                                                <td>{{$publication->name}}</td>
                                                <td>{{$publication->conference_date}}</td>
                                                <td>{{$publication->created_at}}</td>
                                                <td>
                                                      <button type="button" class="btn btn-danger btn-rounded btn-sm btn-condensed mb-control" data-box="#myModalDeletePub_{{$number}}"><span class="fa fa-times"></span></button>

                                                      <div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="myModalDeletePub_{{$number}}">
                                                          <div class="mb-container">
                                                              <form action="{{ action('StudentController@removepublication',$publication->id) }}"  method="POST">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                              <div class="mb-middle">
                                                                  <div class="mb-title"><span class="fa fa-times"></span> Remove Publication</div>
                                                                  <div class="mb-content">
                                                                      <p>Are you sure you want to remove this Publication from the student?</p>
                                                                  </div>
                                                                  <div class="mb-footer">
                                                                      <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                                                                      <button class="btn btn-danger btn-lg pull-right" type="submit">Remove Publication</button>
                                                                  </div>
                                                              </div>
                                                              </form>
                                                          </div>
                                                      </div>

                                                    </td>
                                              </tr>
                                              <?php $number++;?>
                                              @empty
                                              <tr><td colspan="7">No Publication uploaded yet</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                           <h3>Add  Publication to Student</h3>

                           <form action="{{ action('StudentController@addpublication') }}" method="post" accept-charset="utf-8" class="form-horizontal" enctype="multipart/form-data">
                               {{ csrf_field() }}
                               {{ method_field('PUT') }}

                               <div class='form-group'>
                                 <label  class="col-md-3 col-xs-12 control-label" for="description">Title:</label>
                                 <div class="col-md-9 col-xs-12">
                                   <input type="text" class="form-control" name="title"/>
                                 </div>
                               </div>

                               <div class='form-group'>
                                 <label  class="col-md-3 col-xs-12 control-label" for="description">Type:</label>
                                 <div class="col-md-9 col-xs-12">
                                   <select name="type" class="form-control select">
                                     <option value="Conference">Conference</option>
                                     <option value="Journal">Journal</option>
                                  </select>
                                 </div>
                               </div>

                               <div class='form-group'>
                                 <label  class="col-md-3 col-xs-12 control-label" for="description">Conference/Journal Name:</label>
                                 <div class="col-md-9 col-xs-12">
                                   <input type="text" class="form-control" name="name"/>
                                 </div>
                               </div>

                               <div class="form-group">
                                   <label class="col-md-3 col-xs-12 control-label">Conference Date</label>
                                   <div class="col-md-9 col-xs-12">
                                       <div class="input-group">
                                           <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                           <input type="date" class="form-control datepicker" id="conference_date" name="conference_date" value="">
                                       </div>
                                   </div>
                               </div>

                               <div class="form-group push-up-30">
                                   <div class="col-md-6">

                                   </div>
                                   <div class="col-md-6">
                                       <button type="submit" class="btn btn-info btn-block">Add Submission</button>
                                       <input type="hidden" name="student_subject_id" value="{{$studsubj->id}}">
                                   </div>
                               </div>

                          </form>
                         </div>
                     </div>
                 </div>
             </div>

        </div>


        <div class="page-content-wrap page-tabs-item" id="step-6">

                  <div class="row">
                      <div class="col-md-12">

                          <!-- START TIMELINE -->
                          <div class="timeline timeline-right">

                              @forelse($submissiontimelines as $timeline)
                                  <!-- START TIMELINE ITEM -->
                                  <?php $timeline_type = App\SubmissionType::find($timeline->submission_types_id)?>
                                  <div class="timeline-item timeline-item-right">
                                      <div class="timeline-item-info">{{$timeline->submission_date}}</div>
                                      <div class="timeline-item-icon"><span class="fa fa-image"></span></div>
                                      <div class="timeline-item-content">
                                          <div class="timeline-heading">
                                              {{$timeline_type->name}} - {{$timeline_type->description}}
                                          </div>
                                          <div class="timeline-body" id="links">
                                              <div class="row">
                                                  <div class="col-md-4">
                                                      <a href="{{asset($timeline->filepath)}}" title="{{$timeline_type->name}} " data-gallery>
                                                          <img src="{{asset('img/file_icon.png')}}" class="img-responsive img-text"/>
                                                      </a>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="timeline-body comments">
                                              <div class="comment-item">
                                                  <p>{{$timeline->description}}</p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- END TIMELINE ITEM -->
                              @empty
                                <!-- START TIMELINE ITEM -->
                                  <div class="timeline-item timeline-main">
                                      <div class="timeline-date">No Submissions</div>
                                  </div>
                                <!-- END TIMELINE ITEM -->
                              @endforelse
                              <!-- START TIMELINE ITEM -->
                              <div class="timeline-item timeline-item-right">
                                  <div class="timeline-item-info">{{$studsubj->registration_date}}</div>
                                  <div class="timeline-item-icon"><span class="fa fa-user"></span></div>
                                  <div class="timeline-item-content">
                                      <div class="timeline-body text-center">
                                          Registration
                                      </div>
                                  </div>
                              </div>
                              <!-- END TIMELINE ITEM -->

                              <!-- START TIMELINE ITEM -->
                              <div class="timeline-item timeline-main">
                                  <div class="timeline-date"><a href="#"><span class="fa fa-ellipsis-h"></span></a></div>
                              </div>
                              <!-- END TIMELINE ITEM -->
                          </div>
                          <!-- END TIMELINE -->

                      </div>
                  </div>


        </div>

                <!-- END PAGE CONTENT WRAPPER -->


@stop
