<x-layout>
    <header class="bg-white shadow p-4 border-b border-gray-200 font-semibold text-gray-900">
        User Management 
    </header>

    <main class="flex-grow max-w-7xl mx-auto p-6 w-full">

        <form method="POST" action="/admin" class="bg-white p-6 rounded-lg shadow-md mb-8 max-w-full">
             <p>Add new user</p><br>
                @csrf
                <div class="flex space-x-4 items-center">
                    <input type="text" name="username" placeholder="Username" 
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

                    <input type="text" name="full_name" placeholder="Full Name" 
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

                    <select name="role" id="role"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="analyst">Analyst</option>
                        <option value="admin">Admin</option>
                        <option value="inspector">Inspector</option>
                        <option value="broker">Broker</option>
                    </select>

                    <input type="password" name="password" placeholder="Password" 
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

                    <button type="submit" 
                            class="px-6 py-2 bg-yellow-100 text-black rounded-md hover:bg-yellow-100 transition">
                        Create User
                    </button>
                </div>
            </form>

        <div class="relative overflow-x-auto bg-white shadow rounded-lg border border-gray-200 mb-10">
            <table class="w-full text-sm text-left text-gray-700 table-auto">
                <thead class="bg-gray-100 text-gray-900 font-semibold border-b border-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">ID</th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Username</th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Full Name</th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Role</th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Active</th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white hover:bg-gray-50 border-b border-gray-200">
                            <td class="px-6 py-4 align-middle whitespace-nowrap font-medium">{{ $user->id }}</td>
                            <td class="px-6 py-4 align-middle whitespace-nowrap font-medium">{{ $user->username }}</td>
                            <td class="px-6 py-4 align-middle whitespace-nowrap font-medium">{{ $user->full_name }}</td>
                            <td class="px-6 py-4 align-middle whitespace-nowrap font-medium">{{ $user->role }}</td>

                            <td class="px-6 py-4 align-middle whitespace-nowrap font-medium">{{ $user->active ? 'Yes' : 'No' }}</td>
                            <td class="px-6 py-4 align-middle whitespace-nowrap font-medium">
                                <a href="/admin/edit/{{ $user->id }}" class="text-blue-600 hover:underline">Edit</a>
                                <form method="POST" action="/admin/{{ $user->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button>Dzēst</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 

    <div>
        {{ $users->links() }}  {{-- šeit tiek izmantots "paginate", kas ir iebūvēta
                                    laravel metode lai parādītu next / previos automatiski  --}}
    </div>

</x-layout>
