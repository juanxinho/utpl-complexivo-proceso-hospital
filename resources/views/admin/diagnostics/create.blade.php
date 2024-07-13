<x-app-layout>

<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ __('Create New Diagnostic Detail') }}</h2>
            </div>
        </div>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.diagnostics.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ __('Code') }}:</strong>
                            <input type="text" name="code" class="form-control" placeholder="Code">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ __('Description') }}:</strong>
                            <textarea rows="3" class="form-control" style="height:150px" name="description" placeholder="Description (JSON format)"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    </x-app-layout>
