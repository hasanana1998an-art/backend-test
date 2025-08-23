<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * إنشاء دفعة جديدة مرتبطة بالطلب
     * POST /api/payments
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0.01',
            'method' => 'required|string|max:50'
        ]);

        $user = $request->user();

        // التأكد أن الطلب يخص المستخدم الحالي
        $order = Order::where('id', $request->order_id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // تحديد حالة الدفع
        if ($request->method === 'credit_card') {
            $status = 'completed'; // أي دفع ببطاقة ائتمانية دائمًا ناجح
        } else {
            $status = 'pending';   // باقي طرق الدفع قيد الانتظار أو يمكن تعديلها لاحقًا
        }

        // إنشاء الدفعة
        $payment = Payment::create([
            'user_id' => $user->id,
            'order_id' => $order->id,
            'amount' => $request->amount,
            'payment_method' => $request->method,
            'status' => $status
        ]);

        // تحديث حالة الطلب إذا كان الدفع ناجح
        if ($status === 'completed') {
            $order->update([
                'status' => 'paid',
                'payment_type' => $request->method
            ]);
        } else {
            $order->update([
                'status' => 'unpaid',
                'payment_type' => $request->method
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'تمت معالجة عملية الدفع',
            'data' => [
                'payment' => $payment,
                'order' => $order
            ]
        ], 201);
    }
}
