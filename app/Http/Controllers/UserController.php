<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users      = User::with('roles')->get();
        $roles      = Role::all();

        return view('backend.user.index', compact('users', 'roles'));
    }

    public function edit($user_id)
    {
        $user       = User::find($user_id);
        $roles      = Role::all();
        $userRole   = DB::table('model_has_roles')->where('model_id', $user_id)->first();
        //dd($userRole);
        return view('backend.user.edit', compact('user', 'roles', 'userRole'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
            'user_roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole($request->input('user_roles'));

        event(new Registered($user));

        return redirect()->route('user.index', $user->id )->with(['msg' => 'User Created Successfully', 'type' => 'success']);

    }

    public function update(Request $request, $user_id)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'user_roles' => 'required'
        ]);

        try {
            $user = User::find($user_id);

            $user->name     = $request->input('name');
            $user->email    = $request->input('email');

            $user->save();
            // Delete previous assigned role
            DB::table('model_has_roles')->where('model_id', $user_id)->delete();
            // Assign updated role
            $user->assignRole($request->input('user_roles'));

            return redirect()->route('user.index', $user->id )->with(['msg' => 'User Updated Successfully', 'type' => 'success']);

        } catch (\Throwable $e) {
            //dd($e->getMessage());
            return redirect()->back()->with(['msg' => 'Something went wrong, please check and try again', 'type' => 'failed']);
        }
    }

    public function destroy($user_id)
    {
        $user = User::find($user_id);
        $user->delete();
        return redirect()->route('user.index')->with(['msg' => 'Item Deleted Successfully', 'type' => 'success']);
    }
}
