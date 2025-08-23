<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * عرض جميع الطلبات للمشتري الحالي
     * GET /api/orders
     */
    public function index(Request $request)
    {
        $orders = Order::with('items.product')
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $orders->count(),
            'data' => $orders
        ], 200);
    }

    /**
     * إنشاء طلب جديد من السلة
     * POST /api/orders
     */
    public function store(Request $request)
    {
        $user = $request->user();

        // جلب عناصر السلة
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();
        if ($cartItems->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'السلة فارغة'
            ], 400);
        }

        // إنشاء الطلب
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_price' => $cartItems->sum(fn($item) => $item->quantity * $item->product->price),
            'created_at' => now()
        ]);

        // نسخ عناصر السلة إلى عناصر الطلب
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        // تفريغ السلة
        CartItem::where('user_id', $user->id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم إنشاء الطلب بنجاح',
            'data' => $order->load('items.product')
        ], 201);
    }

    /**
     * عرض طلب معين للمشتري
     * GET /api/orders/{id}
     */
    public function show(Request $request, $id)
    {
        $order = Order::with('items.product')
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data' => $order
        ], 200);
    }

    /**
     * عرض جميع الطلبات التي تحتوي على منتجات البائع الحالي
     * GET /api/seller/orders
     */
    public function getSellerOrders()
    {
        $sellerId = Auth::id();

        // استرجاع الطلبات التي تحتوي على منتجات هذا البائع
        $orders = Order::with(['items.product'])
            ->whereHas('items.product', function($query) use ($sellerId) {
                $query->where('user_id', $sellerId);
            })
            ->get();

        // تعديل المنتجات داخل كل طلب لتشمل منتجات البائع فقط
        $orders->transform(function($order) use ($sellerId) {
            $order->items = $order->items->filter(function($item) use ($sellerId) {
                return $item->product && $item->product->user_id == $sellerId;
            })->values();

            // حساب إجمالي السعر للبائع فقط
            $order->total_price = $order->items->sum(fn($item) => $item->price * $item->quantity);

            return $order;
        });

        return response()->json([
            'status' => 'success',
            'count' => $orders->count(),
            'data' => $orders
        ], 200);
    }

    public function allOrders()
    {
    // جلب كل الطلبات مع بيانات المستخدم
    $orders = Order::with('user', 'items.product')->get();
    return response()->json($orders);
    }

        public function getAllOrders()
    {
        $orders = Order::with('user')->get(); // جلب الطلبات مع المستخدمين والمنتجات
        return response()->json($orders);
    }

}
