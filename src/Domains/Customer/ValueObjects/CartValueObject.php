<?php

namespace Domains\Customer\ValueObjects;

class CartValueObject
{
    public function __construct(
        public string $status,
        public ?int $user_id,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'status'  => $this->status,
            'user_id' => $this->user_id,
        ];
    }
}
