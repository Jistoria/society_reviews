<?php

namespace App\Rules;

use App\Models\Franchise;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AfterOrEqualFranchiseFirstRelease implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
{
    $franchise = Franchise::select('first_release')->find(request()->franchise_id);

    if (!(strtotime($value) >= strtotime($franchise))) {
        $fail('La fecha de lanzamiento no debe ser menor a la de la franquicia');
    }
}
}
