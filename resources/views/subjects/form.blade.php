@foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        {{$error}}
    </div>
@endforeach
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('course_unit_id', 'Unidade Curricular', ['class'=>'form-label']) }}
            {{ form()->select('course_unit_id', $course_units, $disciplina->course_unit_id??null, ['class'=>'form-control', 'required']) }}
            <div class="invalid-feedback">
                Selecione a unidade curricular.
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('term', 'Semestre', ['class'=>'form-label']) }}
            {{ form()->text('term', $disciplina->term_formate??null, ['class'=>'form-control term', 'required']) }}
            <div class="invalid-feedback">
                Insira o semestre.
            </div>
        </div>
    </div>
</div>
@if(auth()->user()->level == 0)
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('teacher_id', 'Professor', ['class'=>'form-label']) }}
            {{ form()->select('teacher_id', $teacher, $disciplina->teacher_id??null, ['class'=>'form-control', 'required']) }}
            <div class="invalid-feedback">
                Selecione o professor.
            </div>
        </div>
    </div>
</div>
@else
    {{ form()->hidden('teacher_id', auth()->user()->teacher()->first()->id??null) }}
@endif
<div class="row">
    <button class="btn btn-primary mr-2" type="submit">Salvar</button>
    <a class="btn btn-outline-secondary" href="{{ route('subject.index') }}">Cancelar</a>
</div>

@push('js')
    @include('subjects.scripts.form')
@endpush
