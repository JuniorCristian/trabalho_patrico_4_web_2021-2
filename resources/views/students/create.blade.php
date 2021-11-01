@extends('layouts.app')

@section('title', 'Novo aluno - '.env('APP_NAME'))

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Alunos</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Cadastrar Aluno</h6>
            </div>
            <div class="card-body">
                {{ form()->open(array('url' => route('student.store'))) }}
                    @include('students.form')
                {{ form()->close() }}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
