<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Employee') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">First Name:</label>
                    <input type="text" id="first_name" name="profile[first_name]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $employee->profile->first_name }}" required>
                </div>

                <div class="mb-4">
                    <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Last Name:</label>
                    <input type="text" id="last_name" name="profile[last_name]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $employee->profile->last_name }}" required>
                </div>

                <div class="mb-4">
                    <label for="nid" class="block text-gray-700 text-sm font-bold mb-2">National ID:</label>
                    <input type="text" id="nid" name="profile[nid]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $employee->profile->nid }}" required>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone:</label>
                    <input type="text" id="phone" name="profile[phone]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $employee->profile->phone }}" required>
                </div>

                <div class="mb-4">
                    <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Gender:</label>
                    <select id="gender" name="profile[gender]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="M" {{ $employee->profile->gender == 'M' ? 'selected' : '' }}>Male</option>
                        <option value="F" {{ $employee->profile->gender == 'F' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="dob" class="block text-gray-700 text-sm font-bold mb-2">Date of Birth:</label>
                    <input type="date" id="dob" name="profile[dob]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $employee->profile->dob }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $employee->email }}" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                    <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <p class="text-gray-600 text-xs italic">Leave blank to keep the current password.</p>
                </div>

                <div class="mb-4">
                    <label for="roles" class="block text-gray-700 text-sm font-bold mb-2">Roles:</label>
                    <select id="roles" name="roles[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ in_array($role->id, $employee->roles->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Update Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
