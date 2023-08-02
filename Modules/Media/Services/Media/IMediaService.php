<?php

namespace Modules\Media\Services\Media;

interface IMediaService
{
    public function getAllMediaItems();

    public function uploadMediaItems($request);
}
