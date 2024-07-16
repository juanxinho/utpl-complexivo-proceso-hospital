<x-app-layout>

<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2> Show Diagnostic Detail</h2>
                <a class="btn btn-primary" href="{{ route('admin.diagnostics.index') }}"> Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Code:</strong>
                    {{ $diagnostic->code }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    {{ json_encode($diagnostic->description) }}
                </div>
            </div>
        </div>
    </div>
    </x-app-layout>

