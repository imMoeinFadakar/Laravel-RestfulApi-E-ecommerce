<?php

namespace App\Trait;

use Carbon\Carbon;


trait NameGeneratorForImage {

    public function imageName($imageExtension)
    {
        return  Carbon::now()->microsecond . '.' . $imageExtension;
    }



}





