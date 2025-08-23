<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // عرض كل الإشعارات للمستخدم الحالي
    public function index(Request $request)
    {
        // جلب جميع الإشعارات الخاصة بالمستخدم، الأحدث أولاً
        $notifications = Notification::where('user_id', $request->user()->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        // حساب عدد الإشعارات الجديدة (غير المقروءة)
        $newCount = Notification::where('user_id', $request->user()->id)
                                ->whereNull('read_at')
                                ->count();

        return response()->json([
            'notifications' => $notifications,
            'new_count' => $newCount
        ]);
    }

    // تعليم إشعار كمقروء
    public function markAsRead(Request $request, $id)
    {
        // البحث عن الإشعار للمستخدم الحالي فقط لضمان الأمان
        $notification = Notification::where('id', $id)
                                    ->where('user_id', $request->user()->id)
                                    ->first();

        if ($notification) {
            $notification->read_at = now(); // تعيين الوقت الحالي
            $notification->save();
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'not found'], 404);
    }
}
