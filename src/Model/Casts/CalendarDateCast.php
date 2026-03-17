<?php

declare(strict_types=1);

namespace Maarheeze\CalendarDate\Laravel\Model\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Maarheeze\CalendarDate\CalendarDate;
use UnexpectedValueException;

use function is_string;

/**
 * @implements CastsAttributes<CalendarDate, mixed>
 */
class CalendarDateCast implements CastsAttributes
{
    /**
     * @param array<string, mixed> $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?CalendarDate
    {
        if ($value === null) {
            return null;
        }

        if (is_string($value)) {
            return CalendarDate::createFromFormat(CalendarDate::DEFAULT_STRING_FORMAT, $value);
        }

        throw new UnexpectedValueException('Unable to cast value to CalendarDate');
    }

    /**
     * @param array<string, mixed> $attributes
     * @param CalendarDate|null $value
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof CalendarDate) {
            return $value->format(CalendarDate::DEFAULT_STRING_FORMAT);
        }

        throw new UnexpectedValueException('Unable to cast value from CalendarDate');
    }
}
