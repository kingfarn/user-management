<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        check_user_permission('user.view');

        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        check_user_permission('user.add');
        $roles_data = Role::all();
        $roles = [];
        foreach ($roles_data as $role) {
            $roles[$role->name] = $role->name;
        }
        return view('users/add-edit', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        $user->save();
        response()->json($user);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        check_user_permission('user.edit');
        $user = User::findOrFail($id);
        $roles_data = Role::all();
        $roles = [];
        foreach ($roles_data as $role) {
            $roles[$role->name] = $role->name;
        }

        return view('users/add-edit', compact('user', 'roles'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->withSuccessMessage('User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        check_user_permission('user.delete');
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['status' => ' User Deleted']);
    }

    public function profile($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('users.profile', compact('user'));
        } else {
            return redirect()->back();
        }
    }

    public function profile_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find($id);
        $user->name = $request->name;

        if ($user->email != $request->email) {
            $request->validate([
                'email' => 'required|unique:users,email|email',
            ]);

            $user->email = $request->email;
            $user->email_verified_at = now();
        }

        if (isset($request->image)) {
            if (!empty($user->image)) {
                unlink(public_path('images/' . $user->image));
            }

            $image = $request->file('image');
            $filename = $user->name . '_' . time() . '.' . $request->file('image')->extension();
            $image->move(public_path('images'), $filename);
            $user->image = $filename;
        }
        $user->save();

        return redirect()->route('users.index')
            ->withSuccessMessage('User Profile Updated');
    }

    public function update_password(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        $user = User::find($id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->Save();
            return redirect()->route('users.index')
                ->withSuccessMessage('User Password Has Been Updated');
        } else {
            Alert::error(__('users.old_pass_incorrect'));
            return redirect()->back();
        }
    }
}
