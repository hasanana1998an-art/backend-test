<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * عرض السلة للمستخدم الحالي
     */
    public function index(Request $request)
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $cartItems->count(),
            'data' => $cartItems
        ], 200);
    }

    /**
     * إضافة منتج للسلة
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $userId = $request->user()->id;

        // تحقق إذا المنتج موجود بالفعل في السلة
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // تعديل الكمية
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // إنشاء عنصر جديد في السلة
            $cartItem = CartItem::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'تمت إضافة المنتج للسلة بنجاح',
            'data' => $cartItem
        ], 201);
    }

    /**
     * تعديل كمية عنصر في السلة
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json([
            'status' => 'success',
            'message' => 'تم تعديل كمية المنتج بنجاح',
            'data' => $cartItem
        ], 200);
    }

    /**
     * حذف عنصر من السلة
     */
    public function destroy(Request $request, $id)
    {
        $cartItem = CartItem::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $cartItem->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف المنتج من السلة'
        ], 200);
    }

    /**
     * تفريغ السلة بالكامل
     */
    public function clear(Request $request)
    {
        // حذف جميع العناصر المرتبطة بالمستخدم بدون الحاجة للتحقق من وجودها
        CartItem::where('user_id', $request->user()->id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم تفريغ السلة'
        ], 200);
    }
}
