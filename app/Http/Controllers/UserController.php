<?php
namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('users.index');
    }

    public function getUsers()
{
    return DataTables::of(User::select(['id','name','email']))
        ->addColumn('action', function ($user) {
            return view('users.actions', compact('user'))->render();
        })
        ->rawColumns(['action'])
        ->make(true);
}


    public function create()
    {
        return view('users.create');
    } 

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created!');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted!');
    }
}
