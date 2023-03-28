<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show()
    {
        $users = User::all();
        return view('users', ['users' => $users]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('users');
    }


    public function ban($id)
    {
        User::where('id', $id)->update(['status' => 0]);
        return redirect('users');
    }
    public function Unban($id)
    {
        User::where('id', $id)->update(['status' => 1]);
        return redirect('users');
    }

    public function show_edit($id)
    {
        $user = User::find($id);
        return view('edit', ['user' => $user]);
    }
    public function name_edit($id)
    {
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
    public function pass_edit($id)
    {

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
        $imageName = time().'.'.$request->photo->extension();  
        $request->photo->move(public_path('uploads'), $imageName);
    
        // Save the file name in the user's record
        $user->photo = $imageName;
        $user->save();
    
        // Redirect back to the previous page with a success message
        return back()->with('success', 'Photo uploaded successfully!');
    }
}
