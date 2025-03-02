<?php

namespace App\Services;

abstract class Search
{
    protected $text;
    protected $mask;
    protected $name;
    protected $cmp;

    public function __construct($text, $mask, $name = '')
    {
        $this->text = $text;
        $this->mask = $mask;
        $this->cmp = 0;
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function getCompares()
    {
        return$this->cmp;
    }

    protected function prepare()
    {

    }

    abstract public function run();

}