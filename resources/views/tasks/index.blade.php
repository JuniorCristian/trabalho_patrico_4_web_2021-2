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
                <h6 class="m-0 font-weight-bold text-primary">Listagem de Atividades</h6>
                <a href="{{ route('task.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Nova atividade</a>
            </div>
            <div class="card-body">
                @include('layouts.message')
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Peso</th>
                            <th>Data de Postagem</th>
                            <th>Data de Entrega</th>
                            <th>Disciplina</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    @push('js')
        @include('tasks.scripts.index')
    @endpush
@endsection
