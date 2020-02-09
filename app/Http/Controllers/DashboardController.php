<?php

namespace App\Http\Controllers;

use App\Mail\Quote\ReplyEmail;
use App\Mail\ReplyMail;
use App\Models\Contact;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index()
    {
        $quotes = Quote::query()->orderBy('created_at', 'DESC')->paginate(20);
        return view('quotes', compact('quotes'));
    }

    public function contacts()
    {
        $contacts = Contact::query()->orderBy('created_at', 'DESC')->paginate(20);
        return view('contact', compact('contacts'));
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function contactReply(Request $request)
    {
        $this->validate($request, [
           'message' => 'required',
           'id' => 'required|exists:contacts,id'
        ]);

        $contact = Contact::query()->find($request->id);
        $contact->update(['reply' => $request->message]);

        Mail::to($contact->email)
            ->queue(new ReplyMail($contact));

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function quoteReply(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
            'id' => 'required|exists:quotes,id'
        ]);

        $quote = Quote::query()->find($request->id);
        $quote->update(['reply' => $request->message]);

        Mail::to($quote->email)
            ->queue(new ReplyEmail($quote));

        return redirect()->back();
    }
}
