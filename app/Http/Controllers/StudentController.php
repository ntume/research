<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Subject;
use App\Course;
use App\Student_Subject;
use App\StudentSupervisor;
use App\SubmissionType;
use App\Submission;
use App\StudentExaminer;
use App\Funding;
use App\Publication;
use App\Supervisors;
use App\Examiner;
use App\Http\Requests\StudentsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
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

    public function index($subject_id)
    {
        //
        $subject = Subject::find($subject_id);
        $studinfo['subject_id'] = $subject_id;
        $studinfo['subject'] = $subject->subject;
        $studinfo['subject_code'] = $subject->subject_code;
        $studinfo['year'] = $subject->year;
        $num=0;
        $number=1;
        foreach($subject->students as $student){
          $studinfo[$num]['id'] = $student->id;
          $studinfo[$num]['student_number'] = $student->student_number;
          $studinfo[$num]['fullname'] = $student->fullname;
          $studinfo[$num]['gender'] = $student->gender;
          $studinfo[$num]['id_number'] = $student->id_number;
          $studinfo[$num]['race'] = $student->race;
          $studinfo[$num]['email'] = $student->email;
          $studinfo[$num]['contact'] = $student->contact;
          $studinfo[$num]['registration_date'] = $student->pivot->registration_date;

          if($student->pivot->funding_id > 0){
             $funding = Funding::find($student->pivot->funding_id);
             $studinfo[$num]['fund'] = $funding->name ."<br>". $funding->funder;
          }
          else{
            $studinfo[$num]['fund'] = "No Funding";
          }

          $studinfo[$num]['submit_date'] = $student->pivot->submit_date;
          $studinfo[$num]['submitted'] = $student->pivot->submitted;
          $studinfo[$num]['average_grade'] = $student->pivot->average_grade;
          $studinfo[$num]['completed'] = $student->pivot->completed;
          $studinfo[$num]['number'] = $number;
          $number++;
          $num++;
        }
        $studinfo['loop'] = $num;
        return view('admin.students.index',compact('studinfo'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentsRequest $request)
    {
        //
        $input = $request->all();
        $student['fullname'] = $input["fullname"];
        $student['student_number'] = $input["student_number"];
        $student['id_number'] = $input["id_number"];
        $student['gender'] = $input["gender"];
        $student['race'] = $input["race"];
        $student['email'] = $input["email"];
        $student['contact'] = $input["contact"];

        $subject = Subject::find($input["subject_id"]);
        $course = Course::find($subject->course_id);

        $student['department_id'] = $course->department_id;
        //check if student exists in db
        $checkstudent = Student::where('student_number',$input["student_number"])->orWhere('email',$input["email"])->first();

        if($checkstudent->id){
          $student_id = $checkstudent->id;
        }
        else{
          $newstud = Student::create($student);
          $student_id = $newstud->id;
        }


        $studsubj["subject_id"] = $input["subject_id"];
        $studsubj["student_id"] = $student_id;
        $studsubj["registration_date"] = $input["registration_date"];
        $studsubj["funding_id"] = $input["funding_id"];


        $checkstudsubj = Student_Subject::where('student_id',$student_id)->where('subject_id',$input["subject_id"])->first();

        if(!$checkstudsubj->id){
          Student_Subject::create($studsubj);
        }


        //DB::insert('insert into student_subjects (subject_id,student_id,registration_date) values(?,?,?)',[$input["subject_id"],$newstud->id,$request->registration_date]);

        //open up subject student list

        $subject = Subject::find($input["subject_id"]);
        $studinfo['subject_id'] = $subject->id;
        $studinfo['subject'] = $subject->subject;
        $studinfo['subject_code'] = $subject->subject_code;
        $studinfo['year'] = $subject->year;
        $num=0;
        $number=1;
        foreach($subject->students as $student){
          $studinfo[$num]['id'] = $student->id;
          $studinfo[$num]['student_number'] = $student->student_number;
          $studinfo[$num]['fullname'] = $student->fullname;
          $studinfo[$num]['gender'] = $student->gender;
          $studinfo[$num]['id_number'] = $student->id_number;
          $studinfo[$num]['race'] = $student->race;
          $studinfo[$num]['email'] = $student->email;
          $studinfo[$num]['contact'] = $student->contact;
          $studinfo[$num]['registration_date'] = $student->pivot->registration_date;

          if($student->pivot->funding_id > 0){
             $funding = Funding::find($student->pivot->funding_id);
             $studinfo[$num]['fund'] = $funding->name ."<br>". $funding->funder;
          }
          else{
            $studinfo[$num]['fund'] = "No Funding";
          }

          $studinfo[$num]['submit_date'] = $student->pivot->submit_date;
          $studinfo[$num]['submitted'] = $student->pivot->submitted;
          $studinfo[$num]['average_grade'] = $student->pivot->average_grade;
          $studinfo[$num]['completed'] = $student->pivot->completed;
          $studinfo[$num]['number'] = $number;
          $number++;
          $num++;
        }
        $studinfo['loop'] = $num;
        return view('admin.students.index',compact('studinfo'));
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
        $supervisors = Supervisors::all();
        $fundings = Funding::all();
        $submissiontypes = SubmissionType::all();
        $examiners = Examiner::all();
        $submissiontimelines = Submission::where('student_subject_id',$id)->orderBy('submission_date','DESC')->get();
        $studsubj = Student_Subject::find($id);
        return view('admin.students.view',compact('studsubj','fundings','supervisors','submissiontypes','examiners','submissiontimelines'));
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
    public function update(StudentsRequest $request, $id)
    {
        //
        $input = $request->all();
        $updatestudsubj = Student_Subject::find($id);

        $student['fullname'] = $input["fullname"];
        $student['student_number'] = $input["student_number"];
        $student['id_number'] = $input["id_number"];
        $student['gender'] = $input["gender"];
        $student['race'] = $input["race"];
        $student['email'] = $input["email"];
        $student['contact'] = $input["contact"];

        $subject = Subject::find($input["subject_id"]);
        $course = Course::find($subject->course_id);

        $student['department_id'] = $course->department_id;

        $updatedstud = Student::find($updatestudsubj->student_id);

        $studsubj["subject_id"] = $input["subject_id"];
        $studsubj["student_id"] = $updatedstud->id;
        $studsubj["registration_date"] = $input["registration_date"];
        $studsubj["funding_id"] = $input["funding_id"];

        $updatedstud->update($student);
        $updatestudsubj->update($studsubj);


        $supervisors = Supervisors::all();
        $fundings = Funding::all();
        $submissiontypes = SubmissionType::all();
        $examiners = Examiner::all();
        $submissiontimelines = Submission::where('student_subject_id',$id)->orderBy('submission_date','DESC')->get();
        $studsubj = Student_Subject::find($id);
        return view('admin.students.view',compact('studsubj','fundings','supervisors','submissiontypes','examiners','submissiontimelines'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $student = Student::find($id);
        $student->delete();

        $studsubj = Student_Subject::where('student_id',$id)->where('subject_id',$request->subject_id)->delete();

        $subject = Subject::find($request->subject_id);
        $studinfo['subject_id'] = $subject->id;
        $studinfo['subject'] = $subject->subject;
        $studinfo['subject_code'] = $subject->subject_code;
        $studinfo['year'] = $subject->year;
        $num=0;
        $number=1;
        foreach($subject->students as $student){
          $studinfo[$num]['id'] = $student->id;
          $studinfo[$num]['student_number'] = $student->student_number;
          $studinfo[$num]['fullname'] = $student->fullname;
          $studinfo[$num]['gender'] = $student->gender;
          $studinfo[$num]['id_number'] = $student->id_number;
          $studinfo[$num]['race'] = $student->race;
          $studinfo[$num]['email'] = $student->email;
          $studinfo[$num]['contact'] = $student->contact;
          $studinfo[$num]['registration_date'] = $student->pivot->registration_date;

          if($student->pivot->funding_id > 0){
             $funding = Funding::find($student->pivot->funding_id);
             $studinfo[$num]['fund'] = $funding->name ."<br>". $funding->funder;
          }
          else{
            $studinfo[$num]['fund'] = "No Funding";
          }

          $studinfo[$num]['submit_date'] = $student->pivot->submit_date;
          $studinfo[$num]['submitted'] = $student->pivot->submitted;
          $studinfo[$num]['average_grade'] = $student->pivot->average_grade;
          $studinfo[$num]['completed'] = $student->pivot->completed;
          $studinfo[$num]['number'] = $number;
          $number++;
          $num++;
        }
        $studinfo['loop'] = $num;

        Session::flash('deleted_student','The Student has been deleted');
        return view('admin.students.index',compact('studinfo'));


    }

    /**
     * Remove the specified supervisor from student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function removesupervisor($id)
     {
        $studentsupervisor = StudentSupervisor::find($id);
        $student_subject_id = $studentsupervisor->student_subject_id;
        $studentsupervisor->delete();

        Session::flash('msg','The Supervisor has been removed');

        $supervisors = Supervisors::all();
        $fundings = Funding::all();
        $submissiontypes = SubmissionType::all();
        $examiners = Examiner::all();
        $submissiontimelines = Submission::where('student_subject_id',$student_subject_id)->orderBy('submission_date','DESC')->get();
        $studsubj = Student_Subject::find($student_subject_id);
        return view('admin.students.view',compact('studsubj','fundings','supervisors','submissiontypes','examiners','submissiontimelines'));
     }

     /**
      * assign the specified supervisor to student.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

     public function assignsupervisor(Request $request)
     {
       StudentSupervisor::create($request->all());

         Session::flash('msg','A Supervisor has been assigned');

       $supervisors = Supervisors::all();
       $fundings = Funding::all();
       $submissiontypes = SubmissionType::all();
       $examiners = Examiner::all();
       $submissiontimelines = Submission::where('student_subject_id',$request->student_subject_id)->orderBy('submission_date','DESC')->get();
       $studsubj = Student_Subject::find($request->student_subject_id);
       return view('admin.students.view',compact('studsubj','fundings','supervisors','submissiontypes','examiners','submissiontimelines'));
     }

     /**
      * add the specified file to student.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

     public function addsubmission(Request $request)
     {
       $input = $request->all();

       if($file = $request->file('filepath')) {

           $type = SubmissionType::find($request->submission_types_id);
           $name = $type->name ."_".time();


           $file->move('submissions/'.$request->student_subject_id, $name);
           $filepath = 'submissions/'.$request->student_subject_id."/".$name;

           $input["filepath"] = $filepath;
       }

       Submission::create($input);

      Session::flash('msg','A SuperSubmission has been added');

       $supervisors = Supervisors::all();
       $fundings = Funding::all();
       $submissiontypes = SubmissionType::all();
       $examiners = Examiner::all();
       $submissiontimelines = Submission::where('student_subject_id',$request->student_subject_id)->orderBy('submission_date','DESC')->get();
       $studsubj = Student_Subject::find($request->student_subject_id);
       return view('admin.students.view',compact('studsubj','fundings','supervisors','submissiontypes','examiners','submissiontimelines'));
     }

     /**
      * Remove the specified file from student.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

     public function removesubmission($id){

       $submission = Submission::find($id);
       $student_subject_id = $submission->student_subject_id;
       unlink(public_path() ."/". $submission->filepath);
       $submission->delete();

       Session::flash('msg','A Submission has been removed');

       $supervisors = Supervisors::all();
       $fundings = Funding::all();
       $submissiontypes = SubmissionType::all();
       $examiners = Examiner::all();
       $submissiontimelines = Submission::where('student_subject_id',$student_subject_id)->orderBy('submission_date','DESC')->get();
       $studsubj = Student_Subject::find($student_subject_id);
       return view('admin.students.view',compact('studsubj','fundings','supervisors','submissiontypes','examiners','submissiontimelines'));
     }

     /**
      * Remove the specified examiner from student.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

      public function removeexaminer($id)
      {
         $studentexaminer = StudentExaminer::find($id);
         $student_subject_id = $studentexaminer->student_subject_id;
         $studentexaminer->delete();

         Session::flash('msg','The Examiner has been removed');

         $supervisors = Supervisors::all();
         $fundings = Funding::all();
         $submissiontypes = SubmissionType::all();
         $examiners = Examiner::all();
         $submissiontimelines = Submission::where('student_subject_id',$student_subject_id)->orderBy('submission_date','DESC')->get();
         $studsubj = Student_Subject::find($student_subject_id);
         return view('admin.students.view',compact('studsubj','fundings','supervisors','submissiontypes','examiners','submissiontimelines'));
      }

      /**
       * assign the specified supervisor to student.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */

      public function assignexaminer(Request $request)
      {
        //echo $request->examiner_id;
        StudentExaminer::create($request->all());

        Session::flash('msg','An examiner has been added');

        $supervisors = Supervisors::all();
        $fundings = Funding::all();
        $submissiontypes = SubmissionType::all();
        $examiners = Examiner::all();
        $submissiontimelines = Submission::where('student_subject_id',$request->student_subject_id)->orderBy('submission_date','DESC')->get();
        $studsubj = Student_Subject::find($request->student_subject_id);
        return view('admin.students.view',compact('studsubj','fundings','supervisors','submissiontypes','examiners','submissiontimelines'));
      }

      /**
       * Remove the specified publication from student.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */

       public function removepublication($id)
       {
          $publication = Publication::find($id);
          $student_subject_id = $publication->student_subject_id;
          $publication->delete();

          Session::flash('msg','A publication has been removed');

          $supervisors = Supervisors::all();
          $fundings = Funding::all();
          $submissiontypes = SubmissionType::all();
          $examiners = Examiner::all();
          $submissiontimelines = Submission::where('student_subject_id',$student_subject_id)->orderBy('submission_date','DESC')->get();
          $studsubj = Student_Subject::find($student_subject_id);
          return view('admin.students.view',compact('studsubj','fundings','supervisors','submissiontypes','examiners','submissiontimelines'));
       }

       /**
        * assign the specified supervisor to student.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */

       public function addpublication(Request $request)
       {
         //echo $request->examiner_id;
         Publication::create($request->all());

         Session::flash('msg','A publication has been added');

         $supervisors = Supervisors::all();
         $fundings = Funding::all();
         $submissiontypes = SubmissionType::all();
         $examiners = Examiner::all();
         $submissiontimelines = Submission::where('student_subject_id',$request->student_subject_id)->orderBy('submission_date','DESC')->get();
         $studsubj = Student_Subject::find($request->student_subject_id);
         return view('admin.students.view',compact('studsubj','fundings','supervisors','submissiontypes','examiners','submissiontimelines'));
       }
}
