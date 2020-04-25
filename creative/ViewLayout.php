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
        if (file_exists($phpFile)) {
            require_once $phpFile;
            $this->content = ob_get_clean();
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "<h1>404 Not Found</h1>";
            echo "<h3>Is script <big>$phpFile</big> exists?</h3>";
        }

        if (file_exists($this->getLayoufFile())) {
            require_once $this->getLayoufFile();
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "<h1>404 Not Found</h1>";
            echo "<h3>Is layout <big>{$this->getLayoufFile()}</big> exists?</h3>";
        }
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
