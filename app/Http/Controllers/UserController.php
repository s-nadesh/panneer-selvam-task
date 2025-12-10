<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProfessionalDetail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\DataTables\UsersDataTable;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    // public function getUsers()
    // {
    //     $users = User::select('users.id','users.name','users.email','professional_details.profilepic')
    //             ->leftJoin('professional_details', 'professional_details.user_id', '=', 'users.id');

    //     return DataTables::of($users)
    //         ->addColumn('profile_pics', function($user) {
    //             $image = $user->profilepic 
    //                 ? asset('storage/profile_pics/' . $user->profilepic)
    //                 : asset('default.png');   // optional default image

    //             return '<img src="'.$image.'" width="50" class="rounded-circle" />';
    //         })
    //         ->addColumn('action', function ($user) {
    //             return view('users.actions', compact('user'))->render();
    //         })
    //         ->rawColumns(['profile_pics','action'])
    //         ->make(true);
    // }


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

        $insertedid= User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'role' => 'user',
                    ]);

        if($insertedid->id){

            $profilepicture = "";

            if($request->hasFile('profilepic')){
                
                $file = $request->file('profilepic');
                $profilepicture = time() . '.' . $file->getClientOriginalExtension();

                Storage::disk('public')->putFileAs('profile_pics', $file, $profilepicture);
            }
            
            ProfessionalDetail::create([
                'profilepic'=> $profilepicture,
                'user_id' => $insertedid->id,
                'address' => $request->address,
                'gender' => $request->gender,
                'country' => $request->country,
                'date_of_birth' => $request->date_of_birth

            ]);
        }
        return redirect()->route('users.index')->with('success', 'User created!');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $professional = $user->professionalDetail;
        return view('users.edit', compact('user','professional'));
    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);


        $profilepicture = "";

        if($request->hasFile('profilepic')){
            if($user->profilepic && Storage::exists('public/profilepic/'. $request->profilepic)){    
                Storage::disk('public')->delete('profile_pics/'.$user->profile_pic);
            }
            $file = $request->file('profilepic');
            $profilepicture = time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('public')->putFileAs('profile_pics', $file, $profilepicture);
        }

        $user->professionalDetail()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'profilepic' => $profilepicture,
                'address' => $request->address,
                'gender' => $request->gender,
                'country' => $request->country,
                'date_of_birth' => $request->date_of_birth,
            ]
        );

        return redirect()->route('users.index')->with('success', 'User updated!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted!');
    }
}
