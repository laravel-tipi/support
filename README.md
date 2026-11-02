# Laravel Tipi Support

Shared primitives used by Laravel Tipi packages: small value objects and contracts, plus a thin wrapper around Laravel's validator.

## Requirements

- PHP 8.5+
- Laravel 13 (`illuminate/support`, `illuminate/validation`)

## Installation

```bash
composer require laravel-tipi/support
```

## Included utilities

- `Tipi\Support\Locale` — immutable locale value object. `isActive()` and `isDefault()` describe the locale in the application's global locale list; `isDefault()` is the application-wide default. Scoped defaults, such as a localization context's default, belong to the object that defines them (for example `LocaleContext::isDefault()` in `laravel-tipi/localization`).
- `Tipi\Support\Enums\TextDirection` — left-to-right and right-to-left text direction.
- `Tipi\Support\Data\DataTransferObject` — minimal DTO contract (`fromArray()` / `toArray()`).
- `Tipi\Support\Arr\ArrayHelper` — shared array utilities.
- `Tipi\Support\Validation\Validator` — runs Laravel validation and reports errors under an optional field path (for nested forms).

## License

MIT.
