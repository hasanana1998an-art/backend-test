<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class ProductController extends Controller
{
    /**
     * عرض كل المنتجات النشطة مع إمكانية البحث والتصفية
     * GET /api/products?category_id=1&search=abc
     */
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        // فلترة حسب التصنيف
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // البحث بالاسم
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $products = $query->get();

        return response()->json($products);
    }

    /**
     * إضافة منتج جديد مع إنشاء إشعار للمشرف
     * POST /api/products
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();

        $product = Product::create($validated);

        // 🔹 إنشاء إشعار للمشرف عند إضافة منتج جديد
        $adminId = 1; // معرف المشرف الرئيسي
        Notification::create([
            'user_id' => $adminId,
            'type' => 'product',
            'data' => "تم إضافة منتج جديد: $product->name بواسطة المستخدم " . Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product
        ], 201);
    }

    /**
     * عرض تفاصيل منتج
     * GET /api/products/{id}
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    /**
     * تحديث منتج
     * PUT/PATCH /api/products/{id}
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock_quantity' => 'sometimes|required|integer|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
            'image_url' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product
        ]);
    }

    /**
     * حذف منتج
     * DELETE /api/products/{id}
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }

    /**
     * عرض المنتجات الخاصة بالبائع
     */
    public function getSellerProducts()
    {
        $userId = Auth::id();

        $products = Product::where('user_id', $userId)->get();

        return response()->json($products);
    }

    /**
     * البحث عن المنتجات بالاسم أو الوصف
     * GET /api/products/search?q=...
     */
    public function search(Request $request)
    {
        $query = $request->input('q', ''); // إذا لم يتم إرسال q تصبح فارغة

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with('category')
            ->get();

        return response()->json($products);
    }
}
