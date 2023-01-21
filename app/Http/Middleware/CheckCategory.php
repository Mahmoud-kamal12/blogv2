<?php

namespace App\Http\Middleware;

use App\Models\Category;
use Closure;

class CheckCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $count = Category::all()->count();
        if ($count == 0) {
            session()->flash('addCategory' , 'First You Need To Add Category');
            return redirect(route('categories.create'));
        }
        return $next($request);
    }
}
