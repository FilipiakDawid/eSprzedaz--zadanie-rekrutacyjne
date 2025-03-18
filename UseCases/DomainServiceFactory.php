<?php

declare(strict_types=1);

namespace UseCases;

use Throwable;
use Pet\PetService;
use Illuminate\Log\Logger;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Application;
use UseCases\Contracts\Pet\IPetService;

class DomainServiceFactory
{
    protected Logger $logger;
    protected Application $app;

    protected $bindings = [
        IPetService::class => PetService::class,
    ];

    public function __construct(Application $app, Logger $logger)
    {
        $this->logger = $logger;
        $this->app = $app;
    }

    /**
     * @template T
     * @param class-string<T> $interface
     *
     * @return T
     */
    public function create(string $interface)
    {
        $service_class = Arr::get($this->bindings, $interface);

        try {
            return $this->app->make($service_class);
        } catch (Throwable $throwable) {
            $this->logger->error($throwable->getMessage());
            throw new DomainServiceException($interface);
        }
    }
}