<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;
use Yajra\DataTables\DataTables;

class EnrollmentController extends Controller
{
    public function index()
    {
        if (Auth::user()->level !== 2) {
            return redirect()->route('home');
        }
        $isRegistered = Auth::user()->student()->first()->isRegistered();
        return view('enrollments.index', compact('isRegistered'));
    }

    public function datatable(Request $request)
    {
        $enrollment = Enrollment::student(Auth::user()->student()->first()->ag ?? null);
        return DataTables::make($enrollment)
            ->addColumn('subject', function ($row) {
                return $row->subject()->first()->course_unit_name;
            })
            ->addColumn('term', function ($row) {
                return $row->subject()->first()->term_formate;
            })
            ->addColumn('lock', function ($row) {
                return '<a class="btn btn-primary lock" data-id="'.$row->subject_id.'"><i class="fa fa-ban"></i></a>';
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function create()
    {
        $subjects = Subject::query()
            ->join('course_units', 'course_unit_id', '=', 'course_units.id')
            ->where('course_id', Auth::user()->student()->first()->course_id)
            ->where('term', term_now())
            ->pluck('course_units.name', 'subjects.id');
        return view('enrollments.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Auth::user()->student()->first()->subjects()->syncWithoutDetaching($request->subject_id);
            Session::flash('alert-success', 'Matricula realizada com sucesso!');
            DB::commit();
        }catch (Exception $e){
            Session::flash('alert-error', 'Falha ao realizar Matricula!');
            DB::rollBack();
        }
        return redirect()->route('enrollment.index');
    }

    public function lock(Request $request)
    {
        DB::beginTransaction();
        try {
            $enrollment = Enrollment::where('student_id', Auth::user()->student()->first()->ag)->where('subject_id', intval($request->id_subject))->update(['locked'=>1]);
            Session::flash('alert-success', 'Matricula trancada com sucesso!');
            DB::commit();
        }catch (Exception $e){
            Session::flash('alert-error', 'Falha ao trancar Matricula!');
            DB::rollBack();
        }
        return redirect()->route('enrollment.index');
    }
}
