<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Timeframe implements ValidationRule
{

    protected Carbon $start;

    public function __construct(string $start)
    {
        $this->start = Carbon::parse($start);
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure $attribute (string, ?string = null): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $end = Carbon::parse($value);
        $diff = round($this->start->diffInUTCHours($end), 1);
        if (!$end->betweenIncluded($this->start, $this->start->copy()->addHours(8))) {
            $fail("The maximum timeframe is 8 hours. Current: $diff hours.");
        }
    }
}
