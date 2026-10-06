<?php

declare(strict_types=1);

namespace Tipi\Support\Data;

interface DataTransferObject
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static;

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}