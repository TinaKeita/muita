<x-layout>
<x-slot:title>Edit user</x-slot:title>
    <h1>Edit user</h1>
    <form method="POST" action="/admin/{{ $user->id }}">
        @csrf 
        @method('PUT')
            <label>
                Username: <br><br>
                <input type="text" name="username" value="{{ old("username", $user->username) }}" /> <br><br>
            </label>

            <label>
                Full name: <br><br>
                <input type="text" name="full_name" value="{{ old("full_name", $user->full_name) }}" /> <br><br>
            </label>

            <select name="role" id="role">
                <option value="analyst" {{ old('role', $user->role) == 'analyst' ? 'selected' : '' }}>Analyst</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="broker" {{ old('role', $user->role) == 'broker' ? 'selected' : '' }}>Broker</option>
                <option value="inspector" {{ old('role', $user->role) == 'inspector' ? 'selected' : '' }}>Inspector</option>    
            </select>
            
            <p>Is the user active?</p><br>
            <input type="checkbox" name="active" id="active" value="1" {{ old('active', $user->active) ? 'checked' : '' }} />
            <label for="active">Active</label><br>

            <button>Saglabāt</button>
    </form>
</x-layout>