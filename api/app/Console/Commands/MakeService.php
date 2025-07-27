<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeService extends GeneratorCommand
{
    protected $name = 'make:service';
    protected $description = 'Create a new service class';
    protected $type = 'Service';

    protected function getStub()
    {
        return app_path('Console/Commands/stubs/service.stub');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services';
    }
}
