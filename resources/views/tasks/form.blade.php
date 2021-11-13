@foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        {{$error}}
    </div>
@endforeach
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('subject_id', 'Disciplina', ['class'=>'form-label']) }}
            {{ form()->select('subject_id', $subjects, null, ['class'=>'form-control', 'required']) }}
            <div class="invalid-feedback">
                Selecione a disciplina.
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('name', 'Nome', ['class'=>'form-label']) }}
            {{ form()->text('name', null, ['class'=>'form-control', 'required']) }}
            <div class="invalid-feedback">
                Insira o nome.
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('initial_date', 'Data Inicial', ['class'=>'form-label']) }}
            {{ form()->date('initial_date', null, ['class'=>'form-control', 'required']) }}
            <div class="invalid-feedback">
                Insira a data inicial.
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('final_date', 'Data Final', ['class'=>'form-label']) }}
            {{ form()->date('final_date', null, ['class'=>'form-control', 'required']) }}
            <div class="invalid-feedback">
                Insira a data final.
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('weighted', 'Peso', ['class'=>'form-label']) }}
            {{ form()->text('weighted', null, ['class'=>'form-control weighted', 'required']) }}
            <div class="invalid-feedback">
                Selecione o peso.
            </div>
        </div>
    </div>
</div>
<div class="row">
    <button class="btn btn-primary mr-2" type="submit">Salvar</button>
    <a class="btn btn-outline-secondary" href="{{ route('subject.index') }}">Cancelar</a>
</div>

@push('js')
    @include('tasks.scripts.form')
@endpush
