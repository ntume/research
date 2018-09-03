<?php
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

  if(Auth::check()){
    return "the user is logged in";
  }
  else{
    return view('welcome');
  }
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('login/locked', 'Auth\LoginController@locked')->middleware('auth')->name('login.locked');

Route::post('login/locked', 'Auth\LoginController@unlock')->name('login.unlock');

/*Route::get('/admin/user/roles', ['middleware'=>'role',function(){

  return "Role Middleware";

}]);*/

//Route::get('/admin','AdminController@index');

/*Route::get('/admin',function(){

  return view('admin.index');
});*/

Route::group(['middleware'=>'admin','middleware'=>'auth.lock'], function(){

  Route::get('admin/students/subject/{subject_id}', ['as'=>'admin.students.index', 'uses'=>'StudentController@index']);

  Route::get('admin/students/create', ['as'=>'admin.students.create', 'uses'=>'StudentController@create']);

  Route::post('admin/students/store', ['as'=>'admin.students.store', 'uses'=>'StudentController@store']);

  Route::get('admin/students/edit/{student_subject_id}', ['as'=>'admin.students.edit', 'uses'=>'StudentController@edit']);

  Route::delete('admin/students/destroy/{id}', ['as'=>'admin.students.destroy', 'uses'=>'StudentController@destroy']);

  Route::put('admin/students/update/{id}', ['as'=>'admin.students.update', 'uses'=>'StudentController@update']);

  Route::get('admin/students/show/{student_subject_id}', ['as'=>'admin.students.show', 'uses'=>'StudentController@show']);

  Route::put('admin/students/supervisor/assign', ['as'=>'admin.students.assign', 'uses'=>'StudentController@assignsupervisor']);

  Route::delete('admin/students/supervisor/destroy/{id}', ['as'=>'admin.students.removesupervisor', 'uses'=>'StudentController@removesupervisor']);

  Route::put('admin/students/submission/add', ['as'=>'admin.students.addsubmission', 'uses'=>'StudentController@addsubmission']);

  Route::delete('admin/students/submission/destroy/{id}', ['as'=>'admin.students.removesubmission', 'uses'=>'StudentController@removesubmission']);

  Route::put('admin/students/examiner/assign', ['as'=>'admin.students.assignexaminer', 'uses'=>'StudentController@assignexaminer']);

  Route::delete('admin/students/examiner/destroy/{id}', ['as'=>'admin.students.removeexaminer', 'uses'=>'StudentController@removeexaminer']);

  Route::put('admin/students/publication/add', ['as'=>'admin.students.addpublication', 'uses'=>'StudentController@addpublication']);

  Route::delete('admin/students/publication/destroy/{id}', ['as'=>'admin.students.removepublication', 'uses'=>'StudentController@removepublication']);

  Route::resource('admin/supervisors','SupervisorController',['names'=>[
        'index'=>'admin.supervisors.index',
        'create'=>'admin.supervisors.create',
        'store'=>'admin.supervisors.store',
        'edit'=>'admin.supervisors.edit'
  ]]);

  Route::resource('admin/examiners','ExaminerController',['names'=>[
        'index'=>'admin.examiners.index',
        'create'=>'admin.examiners.create',
        'store'=>'admin.examiners.store',
        'edit'=>'admin.examiners.edit'
  ]]);

  Route::resource('admin/funding','FundingController',['names'=>[
        'index'=>'admin.funding.index',
        'create'=>'admin.funding.create',
        'store'=>'admin.funding.store',
        'edit'=>'admin.funding.edit'
  ]]);
});
