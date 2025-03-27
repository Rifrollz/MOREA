<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;
use App\Models\Subscriber;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('coming-soon');
});

Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');

Route::get('/admin/dashboard', function () {
    $subscriberCount = Subscriber::count();
    $subscribers = Subscriber::latest()->paginate(10); // 👈 Fetch subscribers with pagination
    return view('admin.dashboard', compact('subscriberCount', 'subscribers'));
})->name('admin.dashboard');

Route::post('/subscribe', function (Request $request) { // 👈 $request is now recognized
    $request->validate([
        'email' => 'required|email|unique:subscribers,email',
    ]);

    // Store email
    Subscriber::create(['email' => $request->email]);

    // Send confirmation email
    Mail::to($request->email)->send(new \App\Mail\SubscriptionConfirmation($request->email));

    return response()->json(['success' => true, 'email' => $request->email]);
});