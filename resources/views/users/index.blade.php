{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>--}}


<x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
        {{ __('Users management') }}
    </h2>
</x-slot>

<div class="py-2 md:py-12">


    <a wire:click="create()">Nuevo Usuario</a>

        <a href="{{ route('roles.index') }}" class="mb-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Manage Roles
        </a>

    <div class="mx-auto sm:px-6 lg:px-2">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900 dark:text-gray-500">


            @if (session()->has('message'))
                <div>{{ session('message') }}</div>
            @endif

            <table class="yajra-datatable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Last name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Roles') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->persona->nombres }}</td>
                        <td>{{ $user->persona->apellidos }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
                        <td>
                            <button wire:click="edit({{ $user->id }})">Editar</button>
                            <button wire:click="delete({{ $user->id }})">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{--<script type="text/javascript">
    $(function () {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>--}}
