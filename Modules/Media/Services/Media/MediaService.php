<?php

namespace Modules\Media\Services\Media;

use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Base\Scopes\FilterScope;
use Modules\Base\Scopes\SortScope;
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
            ->filterRecord($request->filter)
            ->sortRecord($request->sort)
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
                    ->usingName($file->getClientOriginalName())
                    ->withCustomProperties([])
                    ->toMediaCollection();
                $mediaItemPath = "media/uploads/{$mediaItem->site->name}/{$mediaItem->uuid}/{$mediaItem->file_name}";
                chmod(public_path($mediaItemPath), 0755);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function deleteMediaItemById($id)
    {
        try {
            $site = Site::firstOrFail();
            $mediaItem = $site->mediaItems()->findOrFail($id)->delete();
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }

    public function deleteMediaItemByIds(array $ids)
    {
        try {
            $site = Site::firstOrFail();
            $mediaItems = $site->mediaItems()->whereIn('id', $ids)->get();
            //For each item to delete both record and file storage
            foreach($mediaItems as $item) {
                $item->delete();
            }
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }
}
