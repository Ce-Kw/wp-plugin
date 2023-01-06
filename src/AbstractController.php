<?php

declare(strict_types=1);

namespace CEKW\WpPlugin;

use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * Base class for custom routes on top of WordPress.
 */
abstract class AbstractController
{
    /**
     * Path to the templates directory for public templates.
     */
    protected string $templatePath;

    public function __construct(
        /**
         * Holds the plugin directory path, URL and basename.
         */
        protected Config $config,
        private UrlGenerator $urlGenerator
    ) {
        $this->templatePath = $config->dirPath . 'templates/';
    }

    /**
     * Generates a URL from the given parameters.
     *
     * @see UrlGenerator
     */
    protected function generateUrl(string $routeName, array $params = []): string
    {
        return home_url($this->urlGenerator->generate($routeName, $params));
    }

    /**
     * Performs a `wp_redirect` to the given URL.
     *
     * @param integer $status The HTTP status code (302 by default).
     */
    protected function redirect(string $url, int $status = 302): void
    {
        wp_redirect($url, $status, static::class);
        exit();
    }

    /**
     * Performs a `wp_redirect` to the given route with the given parameters.
     *
     * @param integer $status The HTTP status code (302 by default).
     */
    protected function redirectToRoute(string $routeName, array $params = [], int $status = 302): void
    {
        $this->redirect($this->generateUrl($routeName, $params), $status);
    }

    /**
     * Sets part of the document title.
     */
    protected function setTitle(string $title): void
    {
        add_filter('document_title_parts', function ($titleParts) use ($title) {
            return array_merge($titleParts, compact('title'));
        });
    }

    /**
     * Sets the canonical URL for the current route.
     */
    protected function setUrl(string $url): void
    {
        add_action('wp_head', function () use ($url) {
            printf('<link rel="canonical" href="%s" />' . PHP_EOL, $url);
        });

        add_filter('get_canonical_url', function () use ($url) {
            return $url;
        });
    }

    /**
     * Injects template into WordPress.
     *
     * @param string $template Path to a template file.
     */
    protected function render(string $template, array $params = []): void
    {
        $code = basename($template) === '404.php' ? 404 : 200;

        add_filter('status_header', fn($statusHeader, $header, $text, $protocol) => "{$protocol} {$code} " . get_status_header_desc($code), 10, 4);

        add_filter('body_class', function ($classes) use ($template) {
            $classes[] = 'page-template';
            $classes[] = 'page-template-' . basename($template, '.php');
            $classes[] = 'page-template-' . sanitize_title(basename($template));
            $classes[] = 'page';

            return $classes;
        });

        add_action('template_redirect', function () use ($code, $params, $template) {
            if ($code !== 404) {
                $GLOBALS['wp_query']->is_404 = false; // phpcs:ignore
            }

            extract($params, EXTR_SKIP);

            include is_readable($template) ? $template : locate_template($template);
            exit;
        });
    }
}