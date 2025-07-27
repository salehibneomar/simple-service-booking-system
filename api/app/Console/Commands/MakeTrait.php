<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeTrait extends GeneratorCommand
{
    protected $name = 'make:trait';
    protected $description = 'Create a new trait';
    protected $type = 'Trait';

    protected function getStub()
    {
        return app_path('Console/Commands/stubs/trait.stub');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Traits';
    }
}
