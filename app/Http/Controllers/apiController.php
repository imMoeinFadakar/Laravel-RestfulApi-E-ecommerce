<?php

namespace App\Http\Controllers;

use App\Trait\ApiResponse;
use App\Trait\FindNewInsertedRecoredTrait;
use App\Trait\FindSingleRecored;
use App\Trait\NameGeneratorForImage;
use Illuminate\Http\Request;

class apiController extends Controller
{
    use ApiResponse ;
    use NameGeneratorForImage;
   

}
