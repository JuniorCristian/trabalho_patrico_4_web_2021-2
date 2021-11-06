@foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        {{$error}}
    </div>
@endforeach
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('name', 'Nome', ['class'=>'form-label']) }}
            {{ form()->text('name', $aluno->name??null, ['class'=>'form-control', 'required']) }}
            <div class="invalid-feedback">
                Insira o nome.
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('email', 'E-mail', ['class'=>'form-label']) }}
            {{ form()->text('email', $aluno->email??null, ['class'=>'form-control', 'required']) }}
            <div class="invalid-feedback">
                Insira o email.
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('entry_date', 'Data de entrada', ['class'=>'form-label']) }}
            {{ form()->date('entry_date', $aluno->entry_date??null, ['class'=>'form-control date', 'required']) }}
            <div class="invalid-feedback">
                Insira a Data de entrada.
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('born_date', 'Data de Nascimento', ['class'=>'form-label']) }}
            {{ form()->date('born_date', $aluno->born_date??null, ['class'=>'form-control date', 'required']) }}
            <div class="invalid-feedback">
                Insira a Data de Nascimento.
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('course_id', 'Curso', ['class'=>'form-label']) }}
            {{ form()->select('course_id', $courses, $aluno->course_id??null, ['class'=>'form-control', 'required']) }}
            <div class="invalid-feedback">
                Selecione o curso.
            </div>
        </div>
    </div>
</div>
<div class="row">
    <button class="btn btn-primary mr-2" type="submit">Salvar</button>
    <a class="btn btn-outline-secondary" href="{{ route('student.index') }}">Cancelar</a>
</div>

@push('js')
    @include('students.scripts.form')
@endpush
