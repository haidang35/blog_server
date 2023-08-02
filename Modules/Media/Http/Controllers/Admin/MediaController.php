<?php

namespace Modules\Media\Http\Controllers\Admin;

use Modules\Base\Http\Controllers\ApiController;
use Modules\Media\Http\Requests\UploadMediaFilesRequest;
use Modules\Media\Services\Media\IMediaService;

class MediaController extends ApiController
{
    public function __construct(protected IMediaService $mediaService)
    {
    }

    public function getAllMediaItems()
    {
        $result = $this->mediaService->getAllMediaItems();
        return $this->handleResponse($result);
    }

    public function uploadMediaFiles(UploadMediaFilesRequest $request)
    {
        $result = $this->mediaService->uploadMediaItems($request);
        return $this->handleResponse($result);
    }
}
