<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        $contact = Contact::all();
        return view('admin.users', compact('users', 'contact'));
    }
    public function create()
    {
        $contact = Contact::all();
        return view('admin.addUser', compact('contact'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|unique:users'
        ], [
            'required' => 'The :attribute Field Is Require',
            'name.size' => 'The :attribute must be exactly :size'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $isChecked = $request->has('active') ? 'yes' : 'no';
        $user->active = $isChecked;
        $user->password = $request->password;
        $user->save();
        $contact = Contact::all();
        return view('admin.addUser', compact('contact'));
    }
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $contact = Contact::all();
        return view('admin.editUser', compact('user', 'contact'));
    }
    public function update(Request $request, string $id)
    {
        $isChecked = $request->has('active') ? 'yes' : 'no';
        User::where('id', $id)->update(['name' => $request->name, 'email' => $request->email, 'password' => $request->password, 'username' => $request->username, 'active' => $isChecked]);
        $users = User::all();
        $contact = Contact::all();
        return redirect('/all_users')->with(compact('users', 'contact'));
    }
}
