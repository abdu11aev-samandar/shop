<?php

use function Pest\Laravel\get;

it('receives a HTTP OK on the home page', function () {
    get(route('home'))
        ->assertStatus(\JustSteveKing\StatusCode\Http::OK);
});
