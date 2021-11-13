@extends('layouts.app')

@section('title', 'Disciplinas - '.env('APP_NAME'))

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Atividades</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Cadastrar Notas</h6>
            </div>
            <div class="card-body">
                {{ form()->open(array('url' => route('task.grades.store', ['atividade'=>$atividade->id]), 'class'=>'needs-validation', 'novalidate')) }}
                @include('layouts.message')
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Aluno</th>
                            <th>Nota</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{!! form()->text('grades['.$student->ag.']', number_format($grades[$student->ag], 1, ',', '.')??null, ['class'=>'form-control grade', 'required'=>'required']) !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="row d-flex justify-content-center">
                    <button class="btn btn-primary mr-2" type="submit">Salvar</button>
                    <a class="btn btn-outline-secondary" href="{{ route('task.index') }}">Voltar</a>
                </div>
                {{ form()->close() }}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @push('js')
        @include('tasks.scripts.grades')
    @endpush
@endsection
