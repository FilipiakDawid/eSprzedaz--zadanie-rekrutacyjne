<?php

declare(strict_types=1);

namespace Pet;

use Illuminate\Contracts\Config\Repository as ConfigContract;

class UrlGenerator
{
    private string $base_url;
    private ConfigContract $config;

    public function __construct(
        ConfigContract $config
    ) {
        $this->config = $config;
        $this->base_url = $config->get('pets.url');
    }

    public function findByStatus(): string
    {
        return $this->base_url . '/' . $this->config->get('pets.find_by_status');
    }

    public function findById(): string
    {
        return $this->base_url . '/' . $this->config->get('pets.find_by_id');
    }

    public function create(): string
    {
        return $this->base_url;
    }

    public function update(): string
    {
        return $this->base_url;
    }

}