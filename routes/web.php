<?php

use Illuminate\Support\Facades\{ Route, Auth };
use App\Http\Controllers\{
    EnrollmentController,
    StudentController,
    CourseController,
    TeacherController,
    SubjectController,
    TaskController,
    GradeController
};

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

    Route::post('disciplinas/datatable', [SubjectController::class, 'datatable'])->name('subject.datatable');
    Route::resource('disciplinas', SubjectController::class)->names('subject');

    Route::post('matriculas/datatable', [EnrollmentController::class, 'datatable'])->name('enrollment.datatable');
    Route::post('matriculas/lock', [EnrollmentController::class, 'lock'])->name('enrollment.lock');
    Route::resource('matriculas', EnrollmentController::class)->only(['index', 'create', 'store'])->names('enrollment');

    Route::get('notas', [GradeController::class, 'index'])->name('grades.index');
    Route::post('notas/datatable', [GradeController::class, 'datatable'])->name('grades.datatable');
    Route::post('notas/{subject}/datatable', [GradeController::class, 'datatableSubject'])->name('grades.subject.datatable');
    Route::get('notas/{subject}/subject', [GradeController::class, 'subject'])->name('grades.subject');

    Route::prefix('atividades')->name('task.')->group(function (){
        Route::post('/datatable', [TaskController::class, 'datatable'])->name('datatable');
        Route::get('{atividade}/notas', [TaskController::class, 'grades'])->name('grades');
        Route::post('{atividade}/notas', [TaskController::class, 'gradesStore'])->name('grades.store');
    });
    Route::resource('atividades', TaskController::class)->names('task');
});

Auth::routes();

