<?php

declare(strict_types=1);

use Tipi\Support\Arr\ArrayHelper;

it('prefixes array keys', function (): void {
    expect(ArrayHelper::prefixKeys(
        items: ['name' => 'Wine', 'description' => 'Red'],
        prefix: 'translation',
    ))->toBe([
        'translation.name' => 'Wine',
        'translation.description' => 'Red',
    ]);
});
