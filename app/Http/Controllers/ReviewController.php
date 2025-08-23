<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    /**
     * عرض كل المراجعات لمنتج معين
     * GET /api/products/{id}/reviews
     */
    public function index($id)
    {
        $product = Product::findOrFail($id);

        $reviews = Review::with('user')
            ->where('product_id', $product->id)
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $reviews->count(),
            'data' => $reviews
        ], 200);
    }

    /**
     * إضافة مراجعة لمنتج معين
     * POST /api/products/{id}/reviews
     */
    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        $review = Review::create([
            'user_id' => $request->user()->id,
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'تمت إضافة المراجعة بنجاح',
            'data' => $review
        ], 201);
    }
}
