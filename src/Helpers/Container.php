<?php

declare(strict_types=1);

namespace Venus\Helpers;

/**
 * Container for dependency injection
 *
 * @package Venus\Helpers
 * @author Thiago <thiiagoms@proton.me>
 * @version 1.0
 */
final class Container
{
    /**
     * Class dependencies
     *
     * @var array<string, callable>
     */
    private array $dependencies = [];

    /**
     * Push class into the container
     *
     * @param string $class
     * @param callable $resolver
     * @return void
     */
    public function add(string $class, callable $resolver): void
    {
        $this->dependencies[$class] = $resolver;
    }

    /**
     * Retrieve a dependency from the container.
     *
     * @param string $class
     * @return mixed
     */
    public function get(string $class)
    {
        if (!array_key_exists($class, $this->dependencies)) {
            throw new \Exception("Dependency {$class} not found.");
        }

        $handler = $this->dependencies[$class];

        return $handler($this);
    }
}
