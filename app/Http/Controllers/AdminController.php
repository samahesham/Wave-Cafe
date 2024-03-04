<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Providers\AdminServiceProvider;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function create()
    {
        return view('admin.login');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'admin_fullname' => 'required|unique:admins|max:150',
            'admin_username' => 'required|unique:admins'
        ], [
            'required' => 'The :attribute field is required.',
            'admin_fullname.size' => 'The :attribute must be exactly :size.',
        ]);

        $admin = new Admin();
        $admin->admin_fullname = $request->admin_fullname;
        $admin->admin_username = $request->admin_username;
        $admin->admin_email = $request->admin_email;
        $admin->password = $request->password;
        $admin->save();
        return redirect('/admin_login');
    }

    public function customLogin(Request $request)
    {
        $admin_username = $request->admin_username;
        $password = $request->password;

        $admin = Admin::where('admin_username', $admin_username)
            ->where('password', $password)
            ->first();

        if ($admin) {
            return redirect('/all_users');
        }

        return redirect()->route('admin_login')->with('error', 'Invalid credentials');
    }
}
