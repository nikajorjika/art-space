<?php

namespace Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(function (string $modelName){
            $namespace = 'Database\\Factories\\';
            $moduleNamespace = Str::before($modelName, '\\Models\\');
            $modelName = Str::afterLast($modelName, '\\');

            return $moduleNamespace.'\\'.$namespace.$modelName.'Factory';
        });
    }
}
