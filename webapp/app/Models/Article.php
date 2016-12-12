<?php


namespace App\Models;


class Article
{
    public $title;
    public $snippet;
    public $image;

    public function __construct($title, $snippet, $image)
    {
        $this->title = $title;
        $this->snippet = $snippet;
        $this->image = $image;
    }
}