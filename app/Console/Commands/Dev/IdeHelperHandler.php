<?php

namespace App\Console\Commands\Dev;

use App\Console\Commands\CommandAbstract;

class IdeHelperHandler extends CommandAbstract
{
    /** @var string $table */
    protected $signature = 'ide-helper:handle';

    /** @var string $description */
    protected $description = 'Handles ide-helper generation through composer.';

    public function handle(): void
    {
        $ideHelperProvider = '\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider';
        if (! in_array(app()->environment(), ['local', 'development']) && class_exists($ideHelperProvider)) {
            $this->log('IDE helpers generation is disabled.', 'error');

            return;
        }
        $this->log('Started IDE helpers generation...', 'title');
        $this->call('ide-helper:eloquent');
        $this->call('ide-helper:generate');
        $this->call('ide-helper:model', ['--dir' => ['app/Models'], '--nowrite' => true]);
        $this->call('ide-helper:meta');
        $this->log('Finished IDE helpers generation.', 'success');
    }
}
