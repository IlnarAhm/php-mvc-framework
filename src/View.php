<?php


namespace Core;


class View
{
    private $templatePath;
    private $data = [];

    public function __construct()
    {
        $this->templatePath = PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app/View';
    }

    public function render(string $tpl, $data = []): string
    {
        $this->data += $data;
        extract($data);
        ob_start();

        $path = $this->templatePath . DIRECTORY_SEPARATOR . $tpl;
        include $path;

        return ob_get_clean();
    }

    public function __get($varName)
    {
        return $this->data[$varName] ?? null;
    }
}