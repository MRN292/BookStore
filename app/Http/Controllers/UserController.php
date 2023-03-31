<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function show()
    {
        // $users = User::all();

        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->get();
        return view('users', ['users' => $users, 'roles' => Role::all()]);
    }

    public function delete(Request $request)
    {
        $id = $request->input('delete');
        $user = User::find($id);
        $user->delete();

        return back()->with('success', 'User deleted successfully!');
        // return var_dump($id);
    }


    public function ban(Request $request)
    {
        $id = $request->input('ban');
        User::where('id', $id)->update(['status' => 0]);
        return back()->with('success', 'User Baned successfully!');
    }
    public function Unban(Request $request)
    {
        $id = $request->input('Unban');
        User::where('id', $id)->update(['status' => 1]);
        return back()->with('success', 'User Unbaned successfully!');
    }

    public function show_edit(Request $request)
    {
        $id = $request->input('edit');
        $user = User::find($id);

        
         return view('edit', ['user' => $user]);
        // return var_dump($id);
    }


    public function name_edit(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        $name = request('name');
        if (preg_match("/^[a-zA-Z\s]+$/", $name)) {
            User::where('id', $id)->update(['name' => $name]);
            $massage = 'Saved successfully';
            $user = User::find($id);
            return view('edit', ['user' => $user, 'massage' => $massage]);
        } else {
            $massage = 'invalid name';
            return view('edit', ['user' => $user, 'name_massage' => $massage, 'name' => $name]);
        }
    }


    public function pass_edit(Request $request)
    {
        $id = $request->input('id');

        $user = User::find($id);
        $pass = request('password');
        if (preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\s]).{8,}$/", $pass)) {
            $pass = Hash::make($pass);
            User::where('id', $id)->update(['password' => $pass]);
            $massage = 'Saved successfully';
            $user = User::find($id);
            return view('edit', ['user' => $user, 'massage' => $massage]);
        } else {
            $massage = 'invalid password';
            return view('edit', ['user' => $user, 'pass_massage' => $massage]);
        }
    }
    public function photo(Request $request)
    {

        $id = Auth::user()->id;
        $user = User::find($id);

        // Validate the uploaded file
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload the file to the server
        $imageName = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('Books'), $imageName);

        // Save the file name in the user's record
        $user->photo = $imageName;
        $user->save();

        // Redirect back to the previous page with a success message
        return back()->with('success', 'Photo uploaded successfully!');
    }
    public function change_role(Request $request)
    {
        $Values = $request->user_role;
        $Values = explode('-', $Values);
        DB::table('model_has_roles')->where('model_id', '=', $Values[1])->update(['role_id' => $Values[0]]);


        return back()->with('success', 'Role changed successfully!');
    }


    public function search_sort(Request $request)
    {
        $search = $request->query('search');
        $sort = $request->query('sort');



        // return $request->query->all();


        if (empty($search)) {
            if ($sort == "Oldest") {

                $users = DB::table('users')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->get();

                // return var_dump($users);
                return view('users', ['users' => $users, 'search' => $search, 'sort' => $sort, 'roles' => Role::all()]);
            } else {
                $users = DB::table('users')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')->latest()
                    ->get();
                return view('users', ['users' => $users, 'search' => $search, 'sort' => $sort, 'roles' => Role::all()]);
            }
        } else {
            if ($sort == "Oldest") {

                $users = DB::table('users')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('name', 'LIKE', "%$search%")
                    ->get();

                // return var_dump($users);
                return view('users', ['users' => $users, 'search' => $search, 'sort' => $sort, 'roles' => Role::all()]);
            } else {
                $users = DB::table('users')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('name', 'LIKE', "%$search%")
                    ->latest()
                    ->get();
                return view('users', ['users' => $users, 'search' => $search, 'sort' => $sort, 'roles' => Role::all()]);
            }
        }
    }
}
