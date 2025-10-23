<?php
namespace App\Http\Controllers;

use App\Models\Cmd;
use App\Models\Inquiry;

class NotificationController extends Controller
{
    public function getCounts()
    {
        return response()->json([
            'pending_orders' => Cmd::where('status', Cmd::STATUS_PENDING)->count(),
            'new_inquiries' => Inquiry::where('read', false)->count()
        ]);
    }
}