<?php

namespace App\Services\SimplePages;

use App\Services\ServiceInterface;
use ErrorException;
use Okipa\LaravelTable\Table;

interface SimplePagesServiceInterface extends ServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function table(): Table;
}
