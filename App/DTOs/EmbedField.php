<?php

namespace DTOs;

readonly class EmbedField
{
    public function __construct(
        public string $name,
        public string $value,
        public bool $inline = false
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name:   $data['name']   ?? throw new \InvalidArgumentException("Missing 'name' in field array"),
            value:  $data['value']  ?? throw new \InvalidArgumentException("Missing 'value' in field array"),
            inline: $data['inline'] ?? false
        );
    }
}
