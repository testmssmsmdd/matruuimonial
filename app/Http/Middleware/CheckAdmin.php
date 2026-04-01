<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user() && $request->user()->role != 'Admin'){
            return redirect()->back();
        }

        if($request->id){
            $createdById = Profile::select('created_by')->where('id',$request->id)->first();
            if(!$createdById){
                return redirect()->route('admin.profile.list');
            }
            if($createdById->created_by != $request->user()->id){
                return redirect()->back();
            }
        }

        return $next($request);
    }
}
