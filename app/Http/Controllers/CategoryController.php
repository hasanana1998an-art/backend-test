<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * عرض جميع التصنيفات (لجميع المستخدمين)
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => 'success',
            'count' => $categories->count(),
            'data' => $categories
        ], 200);
    }

    /**
     * إضافة تصنيف جديد (للمشرف فقط)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'تمت إضافة التصنيف بنجاح',
            'data' => $category
        ], 201);
    }

    /**
     * عرض تفاصيل تصنيف
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'التصنيف غير موجود'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $category
        ], 200);
    }

    /**
     * تعديل تصنيف (للمشرف فقط)
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'التصنيف غير موجود'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string'
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'تم تعديل التصنيف بنجاح',
            'data' => $category
        ], 200);
    }

    /**
     * حذف تصنيف (للمشرف فقط)
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'التصنيف غير موجود'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف التصنيف بنجاح'
        ], 200);
    }
}
