<?php

namespace php_number_link_generator\classes;

class Article
{
    public $id;
    public $title;
    public $lines;

    function __construct($id, $title, $lines){
        $this->id = $id;
        $this->title = $title;
        $this->lines = $lines;
    }
}