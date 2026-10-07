<?php

declare(strict_types=1);

use Tipi\Support\Enums\TextDirection;
use Tipi\Support\Locale;

it('exposes locale state', function (): void {
    $locale = new Locale(
        code: 'en',
        name: 'English',
        nativeName: 'English',
        countryCode: 'GB',
        textDirection: TextDirection::Ltr,
        active: true,
        default: true,
    );

    expect($locale->isActive())->toBeTrue()
        ->and($locale->isInactive())->toBeFalse()
        ->and($locale->isDefault())->toBeTrue()
        ->and($locale->textDirection)->toBe(TextDirection::Ltr);
});
