<?php

class HomeController
{
    public function index()
    {
        $articles = Article::get();
        $data = compact('articles');
        $view = new View('home');
        $view->render($data);
    }
}
