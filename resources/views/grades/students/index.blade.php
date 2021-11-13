@extends('layouts.app')

@section('title', 'Notas - '.env('APP_NAME'))

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Notas</h1>

        <!-- DataTales Example -->
        @foreach($subjects as $subject)
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">{{$subject->course_unit_name}}</h6>
                </div>
                <div class="card-body">
                    @include('layouts.message')
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable{{$subject->id}}" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Peso</th>
                                <th>Nota</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="2">Média</th>
                                <td>{{auth()->user()->student()->first()->calculateAverage($subject->id)}}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <!-- /.container-fluid -->

    @push('js')
        @include('grades.students.scripts.index')
    @endpush
@endsection
