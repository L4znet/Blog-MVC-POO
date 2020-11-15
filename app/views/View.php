<?php

class View
{
    private $template;
    protected $page_title;


    public function __construct($template)
    {
        $this->template = $template;
    }

    public function render($data = [])
    {
        extract($data);
        $message = unflash('message');
        $errors = unflash('errors', []);
        $data = unflash('data', []);
        require('views/' . $this->template .'.php');
    }
}
