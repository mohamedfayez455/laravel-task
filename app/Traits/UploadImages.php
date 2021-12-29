<?php

namespace  App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

trait UploadImages
{

    public function storePhoto($photo, $folder = null)
    {
        $path = public_path('uploads/'.$folder);
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        Image::make($photo)->save(public_path('uploads/' . $folder .'/' . $photo->hashName()));
    }

    public function deletePhoto($photo , $folder = null)
    {
        if ($photo && $photo !== 'default.png'){
            Storage::disk('uploads')->delete($folder.'/' .$photo);
        }
    }

    public function updatePhoto($new_photo,  $old_photo , $folder = null)
    {
        $this->deletePhoto($old_photo , $folder);
        $this->storePhoto($new_photo , $folder);
    }
}
