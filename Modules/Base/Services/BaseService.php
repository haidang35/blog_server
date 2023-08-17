<?php

namespace Modules\Base\Services;

class BaseService
{
    /**
     * @param $data
     * @param $transFields
     * @param $treeKey
     * @return \Illuminate\Support\Collection
     */
    public function formatTranslations(array $data, array $transFields, $treeKey = null): \Illuminate\Support\Collection
    {
        $locale = request()->header(config('client.headers.locale'), config('app.fallback_locale'));
        return collect($data)->map(function($item) use($transFields, $locale, $treeKey){
            foreach($transFields as $field) {
                if(array_key_exists($locale, $item[$field])) {
                    $item[$field] = $item[$field][$locale];
                }else {
                    $item[$field] = null;
                }
            }
            if($treeKey) {
                $item[$treeKey] = $this->formatTranslations($item[$treeKey], $transFields, $treeKey);
            }
            return $item;
        });
    }

    public function formatTranslationsForObject(array $data, array $transFields, $treeKey = null)
    {
        $locale = request()->header(config('client.headers.locale'), config('app.fallback_locale'));
        foreach($transFields as $field) {
            if(array_key_exists($locale, $data[$field])) {
                $data[$field] = $data[$field][$locale];
            }else {
                $data[$field] = null;
            }
        }
        return $data;
    }

    public function getValuesInTree($array, $treeKey, $field)
    {
        $values = [];
        foreach($array as $item) {
            $values[] = $item[$field];
            $values = array_merge($values, $this->getValuesInTree($item[$treeKey], $treeKey, $field));
        }
        return $values;
    }
}
