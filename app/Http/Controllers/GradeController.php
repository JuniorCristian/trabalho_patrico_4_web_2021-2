<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class GradeController extends Controller
{
    public function index()
    {
        if(Auth::user()->level == 2){
            $subjects = Auth::user()->student()->first()->subjects()->get();
            return view('grades.students.index', compact('subjects'));
        }
        return view('grades.index');
    }

    public function datatable(Request $request)
    {
        $subjects = Subject::whereTerm([term_now()])->isTeacher(Auth::user()->teacher()->first()->id??0);
        return DataTables::of($subjects)
            ->addColumn('subject', function ($row){
                return $row->course_unit_name;
            })
            ->addColumn('term', function ($row){
                return $row->term_formate;
            })
            ->addColumn('actions', function ($row){
                return '<a href="'.route('grades.subject', ['subject'=>$row->id]).'" class="btn btn-primary"><i class="fa fa-eye"></i></a>';
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function datatableSubject(Request $request, Subject $subject)
    {
        if(Auth::user()->level == 2){
            $tasks = Task::where('subject_id', $subject->id);
            return DataTables::of($tasks)
                ->addColumn('value', function ($row){
                    return $row->grades()->where('student_id', Auth::user()->student()->first()->ag)->first()->value_fmt??'0,0';
                })
                ->escapeColumns(['*'])
                ->make(true);
        }
        $grades = $subject->query()
            ->join('enrollments', 'subjects.id', '=', 'enrollments.subject_id')
            ->join('students', 'student_id', '=', 'students.ag')
            ->join('tasks', 'subjects.id', '=', 'enrollments.subject_id')
            ->where('subjects.id', $subject->id)
            ->select('student_id', 'tasks.id as task_id', 'tasks.name as task', 'weighted', 'students.name as student')
            ->orderBy('students.name');
        return DataTables::of($grades)
            ->addColumn('grade', function ($row){
                return Grade::query()->where('task_id', $row->task_id)->where('student_id', $row->student_id)->first()->value_fmt??'0,0';
            })
            ->addColumn('average', function ($row) use ($subject){
                $tasks = Task::query()->where('subject_id', $subject->id)->get();
                $weighted = 0;
                $values = 0;
                foreach ($tasks as $task){
                    $grade = $task->grades()->where('student_id', $row->student_id)->first();
                    $values += ($grade->value??0)*$task->weighted;
                    $weighted += $task->weighted;
                }
                return number_format(($weighted!=0&&$values!=0?$values/$weighted:0), '1', ',', '.');
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function subject(Subject $subject)
    {
        $students = Student::join('enrollments', 'ag', '=', 'student_id')->where('subject_id', $subject->id)->get();
        $tasks = Task::where('subject_id', $subject->id)->get();
        return view('grades.subject', compact('subject', 'students', 'tasks'));
    }
}
