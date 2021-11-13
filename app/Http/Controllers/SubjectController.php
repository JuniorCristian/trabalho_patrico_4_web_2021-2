<?php

namespace App\Http\Controllers;

use App\Models\CourseUnit;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class SubjectController extends Controller
{
    public function index()
    {
        return view('subjects.index');
    }

    /**
     * @throws \Exception
     */
    public function datatable(Request $request)
    {
        $subject = Subject::isTeacher(Auth::user()->teacher()->first()->id??0);

        return DataTables::of($subject)
            ->addColumn('course_unit', function ($row){
                return $row->course_unit_name;
            })
            ->editColumn('term', function ($row){
                return $row->term_formate;
            })
            ->addColumn('teacher', function ($row){
                return $row->teacher_name;
            })
            ->addColumn('actions', function ($row){
                $actions = '';
                if(Auth::user()->level == 0){
                    $actions .= '<div class="buttons_datatable">';
                    $actions .= '<a href="'.route('subject.edit', ['disciplina'=>$row->id]).'" class="btn btn-warning mr-2" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>';
                    $actions .= '<a class="btn btn-danger deleta" data-toggle="tooltip" data-placement="top" title="Excluir" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                    $actions .= '</div>';
                }
                return $actions;
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function create()
    {
        $course_units = CourseUnit::query()
            ->join('courses', 'course_id', '=','courses.id')
            ->select(DB::raw('CONCAT(course_units.name, " - ", courses.name) as name_course_unit'), 'course_units.id as idUnit')
            ->pluck('name_course_unit', 'idUnit')->prepend('', '');
        $teacher = Teacher::all()->pluck('name', 'id')->prepend('', '');
        return view('subjects.create', compact('course_units', 'teacher'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Subject::create($request->only(['course_unit_id', 'term', 'teacher_id']));
            Session::flash('alert-success', 'Disciplina cadastrada com sucesso!');
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            dd($e);
            Session::flash('alert-danger', 'Falha ao cadastrar Disciplina!');
        }
        return redirect()->route('subject.index');
    }

    public function show(Subject $subject)
    {
        //
    }

    public function edit(Subject $disciplina)
    {
        $course_units = CourseUnit::query()
            ->join('courses', 'course_id', '=','courses.id')
            ->select(DB::raw('CONCAT(course_units.name, " - ", courses.name) as name_course_unit'), 'course_units.id as idUnit')
            ->pluck('name_course_unit', 'idUnit')->prepend('', '');
        $teacher = Teacher::all()->pluck('name', 'id')->prepend('', '');
        return view('subjects.edit', compact('disciplina', 'course_units', 'teacher'));
    }

    public function update(Request $request, Subject $disciplina)
    {
        DB::beginTransaction();
        try {
            $disciplina->update($request->only(['course_unit_id', 'term', 'teacher_id']));
            Session::flash('alert-success', 'Disciplina atualizada com sucesso!');
            DB::commit();
        }catch (\Exception $e){
            Session::flash('alert-error', 'Falha ao atualizar Disciplina!');
            DB::rollBack();
        }
        return redirect()->route('subject.index');
    }

    public function destroy(Subject $disciplina)
    {
        DB::beginTransaction();
        try {
            $disciplina->delete();
            Session::flash('alert-success', 'Disciplina excluída com sucesso!');
            DB::commit();
        }catch (\Exception $e){
            Session::flash('alert-error', 'Falha ao excluir Disciplina!');
            DB::rollBack();
        }
        return redirect()->route('subject.index');
    }
}
