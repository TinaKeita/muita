<x-layout>
    <x-slot:title>Edit User</x-slot:title>

    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Edit User</h1>

        <form method="POST" action="/admin/{{ $user->id }}" class="space-y-6">
            @csrf 
            @method('PUT')

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" 
                    value="{{ old('username', $user->username) }}" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm" />
            </div>

            <!-- Vards -->
            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" id="full_name" name="full_name" 
                    value="{{ old('full_name', $user->full_name) }}" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm" />
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role" name="role" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="analyst" {{ old('role', $user->role) == 'analyst' ? 'selected' : '' }}>Analyst</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="broker" {{ old('role', $user->role) == 'broker' ? 'selected' : '' }}>Broker</option>
                    <option value="inspector" {{ old('role', $user->role) == 'inspector' ? 'selected' : '' }}>Inspector</option>
                </select>
            </div>

            <!-- Activs? -->
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="active" name="active" value="1" 
                    {{ old('active', $user->active) ? 'checked' : '' }} 
                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                <label for="active" class="text-sm text-gray-700">Active</label>
            </div>

            <!-- Submit poga-->
            <div>
                <button type="submit" 
                    class="px-6 py-2 bg-yellow-300 text-black rounded-md hover:bg-yellow-400 transition">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-layout>
