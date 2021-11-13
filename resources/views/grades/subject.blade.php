@extends('layouts.app')

@section('title', 'Notas - '.env('APP_NAME'))

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Notas - {{ $subject->course_unit_name }}</h1>
        <h5 class="h5 mb-2 text-gray-800">Semestre {{ $subject->term_formate }}</h5>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                @include('layouts.message')
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Aluno</th>
                            <th>Atividade</th>
                            <th>Peso</th>
                            <th>Nota</th>
                            <th>Média</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        @foreach($students as $student)--}}
{{--                            <tr>--}}
{{--                                <td colspan="3">{{ $student->name }}</td>--}}
{{--                            </tr>--}}
{{--                            @foreach($tasks as $task)--}}
{{--                                @php( $grade = $student->grades()->where('task_id', $task->id)->first())--}}
{{--                            <tr>--}}
{{--                                <td>{{ $task->name }}</td>--}}
{{--                                <td>{{ $task->weighted }}</td>--}}
{{--                                <td>{{ $grade->value_fmt??'0,0' }}</td>--}}
{{--                            </tr>--}}
{{--                            @endforeach--}}
{{--                        @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @push('js')
        @include('grades.scripts.subject')
    @endpush
@endsection
