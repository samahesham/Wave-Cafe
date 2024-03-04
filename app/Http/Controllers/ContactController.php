<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function showMessagesInAdminPanel()
    {
        $contact = Contact::all();
        return view('admin.layout', compact('contact'));
    }
    public function index()
    {
        $contact = Contact::all();
        return view('admin.messages', ['contact' => $contact]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_message' => 'required',
        ]);
        $contact = new Contact();
        $contact->contact_name = $request->contact_name;
        $contact->contact_email = $request->contact_email;
        $contact->contact_message = $request->contact_message;
        $contact->save();
        return redirect('/home_page');
    }
    public function show(string $id)
    {
        $cont = Contact::findOrFail($id);
        $contact = Contact::all();
        return view('admin.showMessage', compact('cont', 'contact'));
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        Contact::where('id', $id)->delete();
        return redirect('/all_messages');
    }
    public function delete(string $id)
    {
        Contact::findOrFail($id)->delete();
        return redirect('/all_messages');
    }
}
