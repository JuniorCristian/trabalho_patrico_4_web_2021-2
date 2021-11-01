<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('name', 'Nome', ['class'=>'form-label']) }}
            {{ form()->text('name', null, ['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('course_id', 'Data de entrada', ['class'=>'form-label']) }}
            {{ form()->select('course_id', $courses, null, ['class'=>'form-control']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('entry_date', 'Data de entrada', ['class'=>'form-label']) }}
            {{ form()->text('entry_date', null, ['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{ form()->label('born_date', 'Data de Nascimento', ['class'=>'form-label']) }}
            {{ form()->text('born_date', null, ['class'=>'form-control']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            {{ form()->label('enrollments', 'Matriculas', ['class'=>'form-label']) }}
            {{ form()->select('enrollments', $courses, null, ['class'=>'form-control multiples', 'multiple'=>'multiple']) }}
        </div>
    </div>
</div>

@push('js')
    @include('students.scripts.form')
@endpush
