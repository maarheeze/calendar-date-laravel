# maarheeze/calendar-date-laravel

Laravel integration for [maarheeze/calendar-date](https://github.com/maarheeze/calendar-date).

## Requirements

- PHP 8.2+
- Laravel 8+

## Installation

```bash
composer require maarheeze/calendar-date-laravel
```

## Usage

### Eloquent cast

```php
use Maarheeze\CalendarDate\Casts\CalendarDateCast;

class Article extends Model
{
    protected $casts = [
        'publication_date' => CalendarDateCast::class,
    ];
}
```

The cast handles `null`, `string`, and `DateTimeInterface` values from the database, and stores as `Y-m-d`.

### Blade

Since `CalendarDate` implements `__toString()`, it renders directly in Blade:

```blade
{{ $article->publication_date }} // results in 2000-01-01
{{ $article->publication_date->format('d-m-Y') }} // results in 01-01-2000
```

### Validation

Use a custom constraint for validation in form requests:

```php
use Maarheeze\CalendarDate\Rules\CalendarDateRule;

public function rules(): array
{
    return [
        'publication_date' => ['required', new CalendarDateRule(max: 'today')],
    ];
}
```

## License

MIT