<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Gallery_photos;

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

        $id = $request->route('id');
        if ($id) {

        if ($request->routeIs('admin.profile.delete_gallery_img')) {

                $image = Gallery_photos::find($id);

                if (!$image) {
                    return response()->json(['message' => 'Not found'], 404);
                }

                if ($image->profile->created_by != $request->user()->id) {

                    if ($request->expectsJson()) {
                        return response()->json(['message' => 'Unauthorized'], 403);
                    }

                    return redirect()->back();
                }

            } else {

                $profile = Profile::select('created_by')->find($id);

                if (!$profile) {
                    return redirect()->route('admin.profile.list');
                }

                if ($profile->created_by != $request->user()->id) {

                    if ($request->expectsJson()) {
                        return response()->json(['message' => 'Unauthorized'], 403);
                    }

                    return redirect()->back();
                }
            }
        }


        return $next($request);
    }
}
