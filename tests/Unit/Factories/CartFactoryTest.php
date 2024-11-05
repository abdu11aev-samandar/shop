<?php

it('can create a cart value object', function () {
    expect(Domains\Customer\Factories\CartFactory::make([
        'status' => 'active',
        'user_id' => 1,
    ]))->toBeInstanceOf(Domains\Customer\ValueObjects\CartValueObject::class)
        ->status->toBe('active')
        ->user_id->toBe(1);
});
