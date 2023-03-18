<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifications(){
        
        $notifications = Auth::user()->unreadNotifications;
        return $notifications;
    }

    public function setAsRead($id){
        $notification = Auth::user()->unreadNotifications->where('id', $id)->first();
        
        $notification->markAsRead();

        return response()->json(200);
    }
}
