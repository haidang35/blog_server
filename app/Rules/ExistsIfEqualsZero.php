<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ExistsIfEqualsZero implements ValidationRule
{
    public function __construct(protected $table, protected $field)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value !== 0 && !DB::table($this->table)->where($this->field, $value)->exists()) {
            $fail("The :attribute doesn't exists");
        }
    }
}
