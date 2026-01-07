<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller

{
    public function index()
    {
        // paginate(25) ir lai lapa ieladetu tikai pirmos 25 lietotajus
        $users = User::orderBy('created_at', 'desc')->paginate(25);
        return view('admin.admin', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'full_name' => 'required|string',
            'role' => 'required|in:analyst,admin,inspector,broker',
            'password' => 'required|string|min:6',
        ]);
 
        // dabu pedejo user id
        $lastUser = User::where('id', 'like', 'usr-%')->orderBy('id', 'desc')->first();

        if ($lastUser) {
            $lastNumber = (int)substr($lastUser->id, 4);
            $newNumber = $lastNumber + 1 ;
        } else {
            $newNumber = 1; 
        }

        // jauanis id 
        $newId = 'usr-' . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
    
        User::create([
            'id' => $newId, 
            'username' => $request->username,
            'full_name' => $request->full_name,
            'role' => $request->role,
            'active' => true,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        return redirect()->back()->with('success', 'User created successfully!');
    }

    public function edit($id) {
        $user = User::find($id);
        return view("admin.edit", compact("user"));
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->withErrors('User not found');
        }

        $validated = $request->validate([
            'username' => 'required|string|unique:users,username,' . $user->id,
            'full_name' => 'required|string',
            'role' => 'required|in:analyst,admin,inspector,broker',
            'active' => 'nullable|boolean',
        ]);

        $user->username = $validated['username'];
        $user->full_name = $validated['full_name'];
        $user->role = $validated['role'];
        $user->active = $request->has('active') ? true : false;

        $user->save();
        
        return redirect("/admin");
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect("/admin");
    }

}
