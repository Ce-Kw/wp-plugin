<?php

namespace CEKW\WpPlugin;

use Symfony\Component\Routing\Exception\ExceptionInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Router
{
    public function __construct(
        protected UrlMatcher $matcher,
        protected RequestContext $context
        // phpcs:ignore Squiz.WhiteSpace.ScopeClosingBrace
    ) {}

    public function matchRequest(): void
    {
        try {
            $match = $this->matcher->match($this->context->getPathInfo());
            $params = array_slice($match, 2, -1);

            call_user_func_array([$match['controller'], $match['method']], $params);
        } catch (ExceptionInterface $exception) {
            // Do nothing and let WordPress handle the routing.

            if (!defined('WP_DEBUG') || !WP_DEBUG) {
                return;
            }

            if (is_main_query()) {
                return;
            }

            if (defined('WP_DEBUG_DISPLAY') && WP_DEBUG_DISPLAY) {
                echo $exception->getMessage();
            }

            if (defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
                error_log($exception->getMessage());
            }
        }
    }
}