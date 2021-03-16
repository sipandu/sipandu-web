<?php

namespace App;

use Str;

class Mover
{
    public static function slugFile($file, $folder)
    {
        $image_name = strtolower(time().'_'.$file->getClientOriginalName());
        $image_name = Str::slug($image_name).'.'.strtolower($file->getClientOriginalExtension());
        $file->move(storage_path($folder), $image_name);

        return $folder.$image_name;
    }
}
