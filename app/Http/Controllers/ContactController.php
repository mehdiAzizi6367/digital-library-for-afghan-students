<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

public function store(Request $request)
{
    // Validation
    $request->validate([
        'name' => 'required|max:100',
        'email' => 'required|email',
        'subject' => 'required|min:5|max:200',
        'message' => 'required|min:10'
    ]);

    // Save to database
    Contact::create([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message
    ]);

    return redirect()->back()->with('success','Message sent successfully!');
}
}
