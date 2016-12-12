<?php


namespace App\Models;


class Proposal
{
    public $title;

    public function __construct($title)
    {
        $this->title = $title;
    }
}