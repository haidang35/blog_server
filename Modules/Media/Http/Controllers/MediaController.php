<?php

namespace Modules\Media\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MediaController extends Controller
{
    public function getMediaFile($fileName)
    {
        return response()->file(public_path("media/uploads/{$fileName}"));
    }
}
