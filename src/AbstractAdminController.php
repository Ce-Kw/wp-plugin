<?php

namespace CEKW\WpPlugin;

/**
 * Base class for pages and actions in the WordPress admin.
 */
abstract class AbstractAdminController implements HookSubscriberInterface
{
    /**
     * Path to the templates directory for admin templates.
     */
    protected string $templatePath;

    public function __construct(
        /**
         * Holds the plugin directory path, URL and basename.
         */
        protected Config $config
    ) {
        $this->templatePath = $config->dirPath . 'templates/admin/';
    }

    /**
     * Renders a template.
     */
    protected function render(string $template, array $params = []): string
    {
        if (!file_exists($template)) {
            return '';
        }

        ob_start();
        extract($params, EXTR_SKIP);
        unset($params);
        include $template;

        return ob_get_clean();
    }
}