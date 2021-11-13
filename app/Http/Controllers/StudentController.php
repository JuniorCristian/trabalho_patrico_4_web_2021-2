<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StoreRequest;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    /**
     * @throws Exception
     */
    public function datatable(Request $request)
    {
        $query = Student::whereCourse()
            ->rangeEntryDate()
            ->rangeBornDate();

//        dd(route('student.edit', ['aluno'=>1]));


        return DataTables::of($query)
            ->addColumn('email', function ($row){
                return $row->email;
            })
            ->addColumn('course', function ($row){
                return $row->course()->first()->name;
            })
            ->editColumn('name', function ($row){
                return $row->name;
            })
            ->editColumn('born_date', function ($row){
                return Carbon::createFromFormat('Y-m-d', $row->born_date)->format('d/m/Y');
            })
            ->editColumn('entry_date', function ($row){
                return Carbon::createFromFormat('Y-m-d', $row->entry_date)->format('d/m/Y');
            })
            ->addColumn('actions', function ($row){
                $actions = '<div class="buttons_datatable">';
                $actions .= '<a href="'.route('student.edit', ['aluno'=>$row->ag]).'" class="btn btn-primary mr-2" data-toggle="tooltip" data-placement="top" title="Notas de Atividades"><i class="fa fa-check-double"></i></a>';
                $actions .= '<a href="'.route('student.edit', ['aluno'=>$row->ag]).'" class="btn btn-warning mr-2" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>';
                $actions .= '<a class="btn btn-danger deleta" data-toggle="tooltip" data-placement="top" title="Excluir" data-id="'.$row->ag.'"><i class="fa fa-trash"></i></a>';
                $actions .= '</div>';

                return $actions;
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function create()
    {
        $courses = Course::query()->pluck('name', 'id')->prepend('', '');
        return view('students.create', compact('courses'));
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $formData = $request->only(['name', 'email', 'level']);
            $formData['level'] = 2;
            $user = User::create($formData);
            $formData = $request->only(['name', 'entry_date', 'born_date', 'course_id']);
            $formData['user_id'] = $user->id;
            Student::create($formData);
            Session::flash('alert-success', 'Aluno cadastrado com sucesso!');
            DB::commit();
            return redirect()->route('student.index');
        }catch (Exception $e){
            Session::flash('alert-error', 'Falha ao cadastrar Aluno!');
            DB::rollBack();
            return redirect()->route('student.index');
        }
    }

    public function show(Student $aluno)
    {

    }

    public function edit(Student $aluno)
    {
        $courses = Course::query()->pluck('name', 'id')->prepend('', '');
        return view('students.edit', compact('aluno', 'courses'));
    }

    public function update(Request $request, Student $aluno)
    {
        DB::beginTransaction();
        try {
            $formData = $request->only(['name', 'email']);
            $user = User::find($aluno->user_id);
            $user->updated($formData);
            $formData = $request->only(['name', 'entry_date', 'born_date', 'course_id']);
            $formData['user_id'] = $user->id;
            $aluno->update($formData);
            Session::flash('alert-success', 'Aluno atualizado com sucesso!');
            DB::commit();
        }catch (Exception $e){
            Session::flash('alert-error', 'Falha ao atualizar Aluno!');
            DB::rollBack();
        }
        return redirect()->route('student.index');
    }

    public function destroy(Student $aluno)
    {
        DB::beginTransaction();
        try {
            $user = $aluno->user();
            $aluno->grades()->delete();
            $aluno->enrollments()->delete();
            $aluno->delete();
            $user->delete();
            Session::flash('alert-success', 'Aluno excluído com sucesso!');
            DB::commit();
            return redirect()->route('student.index');
        }catch (Exception $e){
            Session::flash('alert-error', 'Falha ao excluir Aluno!');
            DB::rollBack();
            return redirect()->route('student.index');
        }
    }
}
