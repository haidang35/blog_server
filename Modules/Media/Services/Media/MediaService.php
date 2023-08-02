<?php

namespace Modules\Media\Services\Media;

use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Media\Http\Requests\GetMediaItemsRequest;
use Modules\Media\Repositories\Media\IMediaRepository;
use Modules\Media\Traits\HandleMediaFiles;
use Modules\Site\Entities\Site;

class MediaService implements IMediaService
{
    use HandleMediaFiles;
    public function __construct(protected IMediaRepository $mediaRepository)
    {
    }

    public function getAllMediaItems(GetMediaItemsRequest $request)
    {
        $site = Site::firstOrFail();
        $mediaItems = $site->mediaItems()
            ->latest()
            ->paginate(15);
        return $mediaItems;
    }

    public function uploadMediaItems($request)
    {
        DB::beginTransaction();
        try {
            $site = Site::firstOrFail();
            foreach ($request->images as $file) {
                $imageName = Str::random(48) . '.' . $file->extension();
                $imagePath = public_path("media/temp/{$imageName}");
                $file->move(public_path('media/temp'), $imageName);
                $mediaItem = $site->addMedia($imagePath)
                    ->withCustomProperties([
//                        'file_name' => $file->getClientOriginalName()
                    ])
                    ->usingName($file->getClientOriginalName())
                    ->toMediaCollection();
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }
}
