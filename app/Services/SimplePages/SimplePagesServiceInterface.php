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
     * @return Table
     * @throws ErrorException
     */
    public function table();
}
