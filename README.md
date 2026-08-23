# maarheeze/calendar-date-laravel

Laravel integration for [maarheeze/calendar-date](https://github.com/maarheeze/calendar-date).

## Installation

```bash
composer require maarheeze/calendar-date-laravel
```

## Usage

### Eloquent cast

```php
use Maarheeze\CalendarDate\Laravel\Model\Casts\CalendarDateCast;

class Article extends Model
{
    protected $casts = [
        'publication_date' => CalendarDateCast::class,
    ];
}
```

The cast handles `null` and `string` values from the database, and stores as `Y-m-d`.

### Blade

Since `CalendarDate` implements `__toString()`, it renders directly in Blade:

```blade
{{ $article->publication_date }} // results in 2000-01-01
{{ $article->publication_date->format('d-m-Y') }} // results in 01-01-2000
```

## License

MIT
