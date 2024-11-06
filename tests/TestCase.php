<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function get($uri, array $headers = [])
    {
        return parent::get($uri, $headers);
    }

    public function post($uri, array $data = [], array $headers = [])
    {
        return parent::post($uri, $data, $headers);
    }

    public function patch($uri, array $data = [], array $headers = [])
    {
        return parent::patch($uri, $data, $headers);
    }
}
