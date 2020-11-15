<?php
use Michelf\Markdown;

class Stylizer
{
    public function Markdownify($text)
    {
        $text = Markdown::defaultTransform($text);
        return $text;
    }
}
