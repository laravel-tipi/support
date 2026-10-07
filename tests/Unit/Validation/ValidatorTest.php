<?php

declare(strict_types=1);

use Illuminate\Validation\ValidationException;
use Tipi\Support\Validation\Validator;

it('creates validation exception without a path', function (): void {
    $exception = Validator::validationException([
        'email' => ['The email is invalid.'],
    ]);

    expect($exception->errors())->toBe([
        'email' => ['The email is invalid.'],
    ]);
});

it('prefixes validation errors with a path', function (): void {
    $exception = Validator::validationException([
        'email' => ['The email is invalid.'],
    ], 'data');

    expect($exception->errors())->toBe([
        'data.email' => ['The email is invalid.'],
    ]);
});

it('normalizes the path', function (string $path): void {
    $exception = Validator::validationException([
        'email' => ['The email is invalid.'],
    ], $path);

    expect($exception->errors())->toBe([
        'data.email' => ['The email is invalid.'],
    ]);
})->with([
    'leading dot' => '.data',
    'trailing dot' => 'data.',
    'surrounding dots' => '.data.',
]);

it('treats an empty path as no path', function (): void {
    $exception = Validator::validationException([
        'email' => ['The email is invalid.'],
    ], '');

    expect($exception->errors())->toBe([
        'email' => ['The email is invalid.'],
    ]);
});

it('throws a validation exception for a field', function (): void {
    Validator::fail(
        field: 'email',
        message: 'The email is invalid.',
        path: 'data',
    );
})->throws(ValidationException::class);

it('validates data', function (): void {
    $validated = Validator::validate(
        data: ['name' => 'Saperavi'],
        rules: ['name' => ['required', 'string']],
    );

    expect($validated)->toBe([
        'name' => 'Saperavi',
    ]);
});

it('prefixes validation errors when validation fails', function (): void {
    try {
        Validator::validate(
            data: ['name' => ''],
            rules: ['name' => ['required']],
            path: 'form.data',
        );
    } catch (ValidationException $exception) {
        expect($exception->errors())
            ->toHaveKey('form.data.name')
            ->not->toHaveKey('name');

        return;
    }

    test()->fail('Expected a validation exception.');
});
