@extends('layouts.app')

@section('title', 'Matricula - '.env('APP_NAME'))

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Matricula</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Matricular-se</h6>
            </div>
            <div class="card-body">
                {{ form()->open(array('url' => route('enrollment.store'), 'class'=>'needs-validation', 'novalidate')) }}
                @include('enrollments.form')
                {{ form()->close() }}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
