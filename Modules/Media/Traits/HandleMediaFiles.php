<?php

namespace Modules\Media\Traits;

use Illuminate\Support\Str;

trait HandleMediaFiles
{
    public function uploadFiles(array $files, string $path)
    {
        foreach ($files as $file) {
            $imageName = Str::random(48) . '.' . $file->extension();
            $file->move(public_path($path), $imageName);
        }
    }
}
