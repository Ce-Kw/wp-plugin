<?php

namespace CEKW\WpPlugin;

use Auryn\Injector;
use CEKW\WpPlugin\CommandInterface;
use CEKW\WpPlugin\Attribute\Command;
use WP_CLI;

class DebugInjectorCommand implements CommandInterface
{
    public function __construct(
        protected Injector $injector
        // phpcs:ignore Squiz.WhiteSpace.ScopeClosingBrace
    ) {}

    /**
     * Display classes and interfaces that can be type-hinted.
     *
     * ## OPTIONS
     *
     * [--type=<type>]
     * : Limit the result to the specified type.
     * ---
     * default: all
     * options:
     *   - all
     *   - classDefinitions
     *   - delegates
     *   - prepares
     *   - aliases
     *   - shares
     * ---
     *
     * ## EXAMPLES
     *
     *     wp cekw debug:injector
     *     wp cekw debug:injector --type=aliases
     *
     * @when before_wp_load
     */
    #[Command(name: 'cekw debug:injector')]
    public function __invoke(array $args, array $assocArgs)
    {
        WP_CLI::line("Classes and interfaces that can be type-hinted.\n");

        $classNames = [];
        foreach ($this->injector->inspect() as $type => $inspect) {
            $typeId = $this->typeNameToId($assocArgs['type']);
            if ($assocArgs['type'] !== 'all' && $type !== $typeId) {
                continue;
            }

            foreach ($inspect as $normalizedName => $params) {
                $className = get_class($this->injector->make($normalizedName));
                if (!in_array($className, $classNames)) {
                    $classNames[] = $className;
                }
            }
        }

        if (empty($classNames)) {
            WP_CLI::error('No classes or interfaces found.');
        }

        sort($classNames);

        foreach ($classNames as $className) {
            WP_CLI::line(WP_CLI::colorize("%y{$className}%n"));
        }
    }

    protected function typeNameToId(string $type): int
    {
        switch ($type) {
            case 'classDefinitions':
                return Injector::I_BINDINGS;
            case 'delegates':
                return Injector::I_DELEGATES;
            case 'prepares':
                return Injector::I_PREPARES;
            case 'aliases':
                return Injector::I_ALIASES;
            case 'shares':
                return Injector::I_SHARES;
            case 'all':
            default:
                return Injector::I_ALL;
        }
    }
}