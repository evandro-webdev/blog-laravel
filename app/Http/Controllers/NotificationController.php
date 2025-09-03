<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
  public function markAllAsRead()
  {
    Auth::user()->markAllNotificationsAsRead();
    
    return response()->json(['status' => 'ok']);
  }
}
