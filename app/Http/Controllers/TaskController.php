<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Task;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index');
    }

    public function datatable(Request $request)
    {
        $tasks = Task::teacher();
        return DataTables::of($tasks)
            ->editColumn('initial_date', function ($row) {
                return $row->initial_date_fmt;
            })
            ->editColumn('final_date', function ($row) {
                return $row->final_date_fmt;
            })
            ->addColumn('actions', function ($row) {
                $actions = '<div class="buttons_datatable">';
                $actions .= '<a href="' . route('task.grades', ['atividade' => $row->id]) . '" class="btn btn-primary mr-2" data-toggle="tooltip" data-placement="top" title="Adicionar notas"><i class="fa fa-list-ol"></i></a>';
                $actions .= '<a href="' . route('task.edit', ['atividade' => $row->id]) . '" class="btn btn-warning mr-2" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>';
                $actions .= '<a class="btn btn-danger deleta" data-toggle="tooltip" data-placement="top" title="Excluir" data-id="' . $row->id . '"><i class="fa fa-trash"></i></a>';
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('subject', function ($row) {
                return $row->subject_name;
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function create()
    {
        $subjects = Subject::isTeacher(Auth::user()->teacher()->first()->id??0)->whereTerm()->join('course_units', 'course_unit_id', '=', 'course_units.id')->pluck('course_units.name', 'subjects.id')->prepend('', '');
        return view('tasks.create', compact('subjects'));
    }

    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try{
            Task::create($request->only(['subject_id', 'name', 'weighted', 'initial_date', 'final_date']));
            Session::flash('alert-success', 'Atividade criada com sucesso!');
            DB::commit();
        }catch (Exception $e){
            Session::flash('alert-danger', 'Falha ao criar Atividade!');
            DB::rollBack();
        }
        return redirect()->route('task.index');
    }

    public function edit(Task $atividade)
    {
        //
    }

    public function update(Request $request, Task $atividade)
    {
        //
    }

    public function destroy(Task $atividade)
    {
        //
    }

    public function grades(Task $atividade)
    {
        $grades = Grade::where('task_id', $atividade->id)->pluck('value', 'student_id');
        $students = $atividade->subject()->first()->students()->get();
        return view('tasks.grades', compact('students', 'atividade', 'grades'));
    }

    public function gradesStore(Request $request, Task $atividade): RedirectResponse
    {
        DB::beginTransaction();
        try{
            foreach ($request->grades as $key=>$grade){
                $garde = Grade::firstOrCreate([
                    'student_id'=>$key,
                    'task_id'=>$atividade->id
                ], [
                    'value'=>$grade
                ]);
                $garde->value = $grade;
                $garde->save();
            }
            Session::flash('alert-success', 'Notas gravadas!');
            DB::commit();
        }catch (Exception $e){
            Session::flash('alert-danger', 'Falha ao gravar Notas!');
            DB::rollBack();
        }
        return redirect()->route('task.grades', ['atividade'=>$atividade->id]);
    }
}
