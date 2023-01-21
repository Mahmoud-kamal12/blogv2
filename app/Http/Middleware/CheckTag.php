<?php

namespace App\Http\Middleware;

use App\Models\Tag;
use Closure;

class CheckTag
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
        $count = Tag::all()->count();
        if ($count == 0) {
            session()->flash('addTag' , 'First You Need To Add Tag');
            return redirect(route('tags.create'));
        }
        return $next($request);
    }
}
