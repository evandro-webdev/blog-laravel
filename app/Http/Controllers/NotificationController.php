<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
  public function index()
  {
    $notifications = Auth::user()
      ->notifications()
      ->paginate(6);

    return response()->json([
      'notifications' => $notifications->map(fn ($notification) => [
        'id' => $notification->id,
        'html' => view('components.nav.notifications.notification-item', ['notification' => $notification])->render()
      ]),
      'hasMore' => $notifications->hasMorePages()
    ]);
  }

  public function markAllAsRead()
  {
    Auth::user()->markAllNotificationsAsRead();
    
    return response()->json(['status' => 'ok']);
  }
}
