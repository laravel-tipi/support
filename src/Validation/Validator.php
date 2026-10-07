<?php

declare(strict_types=1);

namespace Tipi\Support\Validation;

use Illuminate\Support\Facades\Validator as BaseValidator;
use Illuminate\Validation\ValidationException;

final readonly class Validator
{
    /**
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $rules
     * @param  array<string, string>  $messages
     * @param  array<string, string>  $attributes
     * @return array<string, mixed>
     *
     * @throws ValidationException
     */
    public static function validate(
        array $data,
        array $rules,
        array $messages = [],
        array $attributes = [],
        ?string $path = null,
    ): array {
        try {
            return BaseValidator::make(
                data: $data,
                rules: $rules,
                messages: $messages,
                attributes: $attributes,
            )->validate();
        } catch (ValidationException $exception) {
            throw self::validationException(
                errors: $exception->errors(),
                path: $path,
            );
        }
    }

    /**
     * @param  array<string, array<int, string>|string>  $errors
     */
    public static function validationException(
        array $errors,
        ?string $path = null,
    ): ValidationException {
        return ValidationException::withMessages(
            collect($errors)
                ->mapWithKeys(
                    fn (array|string $messages, string $field): array => [
                        self::fieldPath($field, $path) => $messages,
                    ],
                )
                ->all(),
        );
    }

    public static function fail(
        string $field,
        string $message,
        ?string $path = null,
    ): never {
        throw ValidationException::withMessages([
            self::fieldPath($field, $path) => $message,
        ]);
    }

    private static function fieldPath(
        string $field,
        ?string $path,
    ): string {
        $path = trim((string) $path, '.');

        return $path === ''
            ? $field
            : "$path.$field";
    }
}
