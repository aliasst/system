<?php

namespace core;

class View
{
    public string $content = '';

    public function __construct (
        public $route,
        public $layout = '',
        public $view = '',
        public $meta = '',
    )
    {
        if(false !== $layout) {
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    public function render($data) {
        if(is_array($data)) {
            extract($data);
        }

        $view_file = APP . "/views/{$this->route['controller']}/{$this->view}.php";

        if(is_file($view_file)) {
            ob_start();
            require_once $view_file;
            $this->content = ob_get_clean();
        } else {
            throw new \Exception("Вид {$view_file} не найден", 500);
        }

        if(false !== $this->layout){
            $layout_file = APP . "/views/layouts/{$this->layout}.php";
            if(is_file($layout_file)) {
                require_once $layout_file;
            } else {
                throw new \Exception("Шаблон {$layout_file} не найден", 500);
            }
        }




    }



    public function getMeta()
    {
        $out = '<title>' . h($this->meta['title']) . '</title>' .PHP_EOL;
        $out .= '<meta name="description" content=" ' . h($this->meta['description']) . '"/>'.PHP_EOL;
        $out .= '<meta name="keywords" content=" ' . h($this->meta['keywords']) . '"/>'.PHP_EOL;
        return $out;
    }

    public function getDbLogs()
    {
        if(DEBUG){
            $logs = [];
            debug($logs);
        }
    }

    public function getPart($file, $data = null)
    {
        if(is_array($data)){
            extract($data);
        }
        $file = APP . "/views/{$file}.php";
            if(is_file($file)) {
                require $file;
            } else {
                echo "File {$file} not found";
            }
    }



}