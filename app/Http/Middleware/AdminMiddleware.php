<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu chưa đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Kiểm tra nếu không phải admin
        if (!$request->user()->isAdmin()) {
            // Có thể redirect về trang khác hoặc trả về lỗi 403
            return redirect()->route('welcome')->with('error', 'Bạn không có quyền truy cập');
            // Hoặc: abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
