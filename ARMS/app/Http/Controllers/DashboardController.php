<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\AlertNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function sendNotification()
    {
        $user = User::where('id', Auth()->user()->id)->first();

        $details = [
            'greetings' => 'Hi Arms User',
            'body' => 'This is my first notification from arms.com',
            'thanks' => 'Thank you for using arms bro!!',
            'actionText' => 'Please take action',
            'actionURL' => url('/dashboard'),
            'greetings' => 001,
        ];

        Notification::send($user, new AlertNotification($details));
    }
}
