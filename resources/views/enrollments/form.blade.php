@foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        {{$error}}
    </div>
@endforeach
<div class="row">
    <div class="col-12">
        <div class="form-group">
            {{ form()->label('subject_id[]', 'Disciplina', ['class'=>'form-label']) }}
            {{ form()->select('subject_id[]', $subjects, null, ['class'=>'form-control selectList', 'required', 'multiple']) }}
            <div class="invalid-feedback">
                Selecione as disciplinas.
            </div>
        </div>
    </div>
</div>
<div class="row">
    <button class="btn btn-primary mr-2" type="submit">Salvar</button>
    <a class="btn btn-outline-secondary" href="{{ route('subject.index') }}">Cancelar</a>
</div>

@push('js')
    @include('enrollments.scripts.form')
@endpush
