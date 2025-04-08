<?php

namespace Core;

class Router
{
    protected array $routes = [];
    protected array $params = [];

    public function __get(string $property): array|false
    {
        switch ($property) {
            case 'routes':
            case 'params':
                return $this->$property;
            default:
                return false;
        }
    }

    public function add(string $route, array $params): void
    {
        $this->routes[$route] = $params;
    }
}