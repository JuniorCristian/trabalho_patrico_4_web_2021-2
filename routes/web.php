<?php

use Illuminate\Support\Facades\{ Route, Auth };
use App\Http\Controllers\{ StudentController, CourseController, TeacherController };

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

Route::resourceVerbs([
    'create'=>'cadastro',
    'edit'=>'editar'
]);

Route::middleware('auth')->group(function (){
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard.index');
    Route::redirect('/home', '/')->name('home');

    Route::post('alunos/datatable', [StudentController::class, 'datatable'])->name('student.datatable');
    Route::resource('alunos', StudentController::class)->names('student');

    Route::resource('professores', TeacherController::class)->names('teacher')->parameters(['professore'=>'teacher']);

    Route::resource('cursos', CourseController::class)->names('course')->parameters(['curso'=>'course']);
});

Auth::routes();

