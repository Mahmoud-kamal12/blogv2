<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Helper
{
    public static function uploadImage(Request $request , Model $post , $remove = false, $filed = 'image' , $folder = 'images/posts')
    {
        if ($request->hasFile($filed)) {
            $path = "uploads/".Storage::disk('public')->putFile($folder, $request->file($filed));
            if($remove)
                Storage::disk('public')->delete($post->$filed);
            return $path;
        }
        return null;
    }
}