@if(session()->has('alert-primary'))
    <div class="alert alert-primary" role="alert">
        {{ session()->get('alert-primary') }}
    </div>
@endif
@if(session()->has('alert-secondary'))
    <div class="alert alert-secondary" role="alert">
        {{ session()->get('alert-secondary') }}
    </div>
@endif
@if(session()->has('alert-success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('alert-success') }}
    </div>
@endif
@if(session()->has('alert-danger'))
    <div class="alert alert-danger" role="alert">
        {{ session()->get('alert-danger') }}
    </div>
@endif
@if(session()->has('alert-warning'))
    <div class="alert alert-warning" role="alert">
        {{ session()->get('alert-warning') }}
    </div>
@endif
@if(session()->has('alert-info'))
    <div class="alert alert-info" role="alert">
        {{ session()->get('alert-info') }}
    </div>
@endif
@if(session()->has('alert-light'))
    <div class="alert alert-light" role="alert">
        {{ session()->get('alert-light') }}
    </div>
@endif
@if(session()->has('alert-dark'))
    <div class="alert alert-dark" role="alert">
        {{ session()->get('alert-dark') }}
    </div>
@endif
