<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    /**
     * @throws \Exception
     */
    public function datatable(Request $request)
    {
        $query = Student::whereCourse()
            ->rangeEntryDate()
            ->rangeBornDate();


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
                $actions .= '<a class="btn btn-primary mr-2" data-toggle="tooltip" data-placement="top" title="Notas de Atividades"><i class="fa fa-check-double"></i></a>';
                $actions .= '<a class="btn btn-warning mr-2" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>';
                $actions .= '<a class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="fa fa-trash"></i></a>';
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

    public function store(Request $request)
    {
        //
    }

    public function show(Student $student)
    {
        //
    }

    public function edit(Student $student)
    {
        //
    }

    public function update(Request $request, Student $student)
    {
        //
    }

    public function destroy(Student $student)
    {
        //
    }
}
