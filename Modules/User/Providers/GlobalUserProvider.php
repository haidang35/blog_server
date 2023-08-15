<?php

namespace Modules\User\Providers;

use Illuminate\Auth\EloquentUserProvider;

class GlobalUserProvider extends EloquentUserProvider
{
    public function createModel() {
        $model = parent::createModel();
        return $model->withoutGlobalScopes();
    }
}
