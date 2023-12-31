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
use Spatie\MediaLibrary\MediaCollections\FileAdder;

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
            $requestFileNames = [];
            foreach ($request->images as $key => $image) {
                $requestFileNames[] = "images[{$key}]";
            }
            $fileNames = [];
            $mediaItem = $site->addMultipleMediaFromRequest($requestFileNames)
                ->each(function ($fileAdder, $key) use ($request) {
                    $extension = $request->images[$key]->extension();
                    $fileName = Str::uuid() . '.' . $extension;
                    $fileNames[] = $fileName;
                    $fileAdder
                        ->usingFileName($fileName)
                        ->toMediaCollection();
                });
            foreach($fileNames as $fName) {
                chmod($fName, 0755);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return false;
        }
    }

    public function deleteMediaItemById($id)
    {
        try {
            $site = Site::firstOrFail();
            $mediaItem = $site->mediaItems()->findOrFail($id)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteMediaItemByIds(array $ids)
    {
        try {
            $site = Site::firstOrFail();
            $mediaItems = $site->mediaItems()->whereIn('id', $ids)->get();
            //For each item to delete both record and file storage
            foreach ($mediaItems as $item) {
                $item->delete();
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
