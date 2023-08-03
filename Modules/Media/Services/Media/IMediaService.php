<?php

namespace Modules\Media\Services\Media;

use Modules\Media\Http\Requests\GetMediaItemsRequest;

interface IMediaService
{
    public function getAllMediaItems(GetMediaItemsRequest $request);

    public function uploadMediaItems($request);

    public function deleteMediaItemById($id);
    public function deleteMediaItemByIds(array $ids);
}
