<?php

declare(strict_types=1);

namespace Maarheeze\CalendarDate\Laravel\Casts;

use DateTimeInterface;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Maarheeze\CalendarDate\CalendarDate;
use UnexpectedValueException;

use function get_debug_type;
use function is_string;
use function sprintf;

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

        if ($value instanceof DateTimeInterface) {
            return CalendarDate::instance($value);
        }

        if (is_string($value)) {
            return CalendarDate::createFromFormat(CalendarDate::DEFAULT_STRING_FORMAT, $value);
        }

        throw new UnexpectedValueException(
            sprintf('Cannot cast value of type %s to CalendarDate', get_debug_type($value)),
        );
    }

    /**
     * @param array<string, mixed> $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof CalendarDate) {
            return $value->format(CalendarDate::DEFAULT_STRING_FORMAT);
        }

        throw new UnexpectedValueException(
            sprintf('Cannot cast value of type %s from CalendarDate', get_debug_type($value)),
        );
    }
}
