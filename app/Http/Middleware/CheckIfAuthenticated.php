<?php
// app/Http/Middleware/CheckIfAuthenticated.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return response()->json(['authenticated' => true]);
        }

        return response()->json(['authenticated' => false]);
    }
}
