<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // تسجيل مستخدم جديد
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:admin,seller,buyer',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'بيانات الدخول غير صحيحة'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // جلب بيانات المستخدم الحالي
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'تم تسجيل الخروج بنجاح']);
    }

    // جلب كل المستخدمين (Admin فقط)
    public function allUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    // تعديل بيانات المستخدم أو تغييره الدور (Admin فقط)
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => 'not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'role' => 'sometimes|in:buyer,seller,admin'
        ]);

        $user->update($request->only('name', 'email', 'role'));

        return response()->json([
            'status' => 'success',
            'user' => $user
        ]);
    }

    // حذف مستخدم (Admin فقط)
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'تم حذف المستخدم']);
    }
}
