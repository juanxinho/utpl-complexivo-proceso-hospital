<x-app-layout>

<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Diagnostic Details</h2>
                <a href="{{ route('admin.diagnostics.create') }}" class="btn btn-success">Create New Diagnostic Detail</a>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <th>Code</th>
                    <th>Description</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($diagnosticDetails as $diagnosticDetail)
                    <tr>
                        <td>{{ $diagnosticDetail->code }}</td>
                        <td>{{ $diagnosticDetail->description }}</td>
                        <td>
                            <form action="{{ route('admin.diagnostics.destroy',$diagnosticDetail->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('admin.diagnostics.show',$diagnosticDetail->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('admin.diagnostics.edit',$diagnosticDetail->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    </x-app-layout>

