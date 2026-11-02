<?php

declare(strict_types=1);

namespace Tipi\Support;

use Tipi\Support\Enums\TextDirection;

/**
 * A locale as Tipi packages exchange it. Immutable.
 *
 * The active and default flags describe the locale in the application's
 * global locale list: exactly one locale is the application-wide
 * default. Narrower defaults, such as a localization context's default,
 * are not stored here; ask the object that defines them.
 */
final readonly class Locale
{
    public function __construct(
        public string $code,
        public string $name,
        public string $nativeName,
        public ?string $nativeAbbreviation,
        public ?string $countryCode,
        public TextDirection $textDirection,
        private bool $active,
        private bool $default,
    ) {}

    public function isActive(): bool
    {
        return $this->active;
    }

    public function isInactive(): bool
    {
        return ! $this->active;
    }

    /**
     * Whether this is the application-wide (global) default locale.
     */
    public function isDefault(): bool
    {
        return $this->default;
    }
}
