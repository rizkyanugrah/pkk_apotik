<?php

namespace App\Http\Controllers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function imageUpload($image, $location)
    {
        $random = mt_rand(1000000, 9999999) . '_' . date('dmY') . '_' . $image->getClientOriginalName();
        $destination = public_path($location);
        $image->move($destination, $random);

        $url = $location . $random;

        return $url;
    }
}
