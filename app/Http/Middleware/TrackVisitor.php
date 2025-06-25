<?php

namespace App\Http\Middleware;

use App\Models\OnlineUser;
use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Tăng lượt truy cập
        Visitor::incrementToday();

        // Xóa các user hết hạn và cập nhật trạng thái online
        OnlineUser::cleanup();
        OnlineUser::updateOnlineStatus($request->ip());

        return $next($request);
    }
} 