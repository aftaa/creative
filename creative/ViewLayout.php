<?php


namespace creative;

use stdClass;

/**
 * Class ViewLayout
 * @package creative
 */
class ViewLayout
{
    private stdClass $app;
    private string $content;

    /**
     * ViewLayout constructor.
     * @param stdClass $app
     */
    public function __construct(stdClass $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $phpFile
     */
    public function capture(string $phpFile): void
    {
        ob_start();
        $app = $this->app;
        $this->breadcrumbs = [];
        require_once $phpFile;
        $this->content = ob_get_clean();
        require_once $this->getLayoufFile();
    }

    /**
     * @return string
     */
    private function getLayoufFile(): string
    {
        return join('/', [
            $this->app->config['layout_path'],
            $this->app->config['layout'],
        ]);
    }
}
