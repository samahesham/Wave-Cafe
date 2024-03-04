<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;


class VerificationController extends Controller
{
    //
    public function verify(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        if ($admin->hasVerifiedEmail()) {
            return redirect()->route('admin.login')->with('error', 'Email address has already been verified.');
        }

        if ($admin->markEmailAsVerified()) {
            event(new Verified($admin));
        }

        return redirect()->route('admin.login')->with('success', 'Email address has been verified successfully.');
    }
}
