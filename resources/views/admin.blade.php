<x-layout>
    <form method="POST" action="/admin">
        @csrf
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="full_name" placeholder="Full Name">
        <select name="role" id="role">
            <option value="analyst">Analyst</option>
            <option value="admin">Admin</option>
            <option value="inspector">Inspector</option>
            <option value="broker">Broker</option>
        </select>
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Create User</button>
    </form> 

<table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Active</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->active ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $users->links() }}  {{-- šeit tiek izmantots "paginate", kas ir iebūvēta
                                    laravel metode lai parādītu next / previos automatiski  --}}
    </div>

</x-layout>
