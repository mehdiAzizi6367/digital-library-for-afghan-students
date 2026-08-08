<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\ContactReply;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReplyMail;
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
  
     public function message(Request $request)
    {
        $query = Contact::latest();

        if ($request->filter == 'unread') {
            $query->where('is_read', false);
        } elseif ($request->filter == 'read') {
            $query->where('is_read', true);
        }

        $contacts = $query->paginate(10);

        return view('admin.message.index', compact('contacts'));
    }
    // ContactController.php



// Reply form
public function reply(Contact $contact)
{
    $contact->load('replies.admin');
    return view('admin.message.reply', compact('contact'));
}

// Send reply
public function sendReply(Request $request, Contact $contact)
{
    $request->validate([
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string|min:5',
    ]);

    // Save reply to database
    $reply = ContactReply::create([
        'contact_id' => $contact->id,
        'admin_id'   => auth()->id(),
        'subject'    => $request->subject,
        'message'    => $request->message,
    ]);

    // Mark as read if requested
    if ($request->has('mark_read')) {
        $contact->update(['is_read' => true]);
    }

    // Send email
    try {
        Mail::to($contact->email)->send(new ContactReplyMail($contact, $reply));
    } catch (\Exception $e) {
        return back()->with('error', __('message.reply_email_failed'));
    }

    return redirect()
        ->route('contact.show', $contact->id)
        ->with('success', __('message.reply_sent_successfully'));
}

    // ✅ Show single message
    public function show(Contact $contact)
    {
        return view('admin.message.show', compact('contact'));
    }

    // ✅ Toggle read/unread
    public function toggleRead(Contact $contact)
    {
        $contact->is_read = !$contact->is_read;
        $contact->save();

        $msg = $contact->is_read
            ? __('message.marked_as_read')
            : __('message.marked_as_unread');

        return back()->with('success', $msg);
    }

    // ✅ Delete
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.contact.message')
            ->with('success', __('message.message_deleted'));
    }
}
