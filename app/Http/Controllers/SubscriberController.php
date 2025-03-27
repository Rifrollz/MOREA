<?php

namespace App\Http\Controllers;
use App\Mail\SubscriptionConfirmation;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use App\Models\Suggestion;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',

        ]);

       $subscriber =  Subscriber::create(['email' => $request->email]);

       // Send email to the subscriber
       Mail::to($subscriber->email)->send(new SubscriptionConfirmation($subscriber->email));

        return back()->with('success', 'You have been subscribed successfully');
    }
    public function dashboard()
    {
        // Fetch subscribers with pagination
        $subscribers = Subscriber::paginate(10);

        // Fetch suggestions
        $suggestions = Suggestion::all();

        // Pass data to the view
        return view('admin.dashboard', [
            'subscriberCount' => Subscriber::count(),
            'subscribers' => $subscribers,
        ]);
    }
}