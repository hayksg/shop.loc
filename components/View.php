<?php

namespace App\Components;

class View
{
    protected $data = [];
    const PATH = ROOT . '/views/';

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        return $this->data[$key];
    }

    public function display($template)
    {
        foreach ($this->data as $key => $value) {
            $$key = $value;
        }

        require_once(self::PATH . $template);
    }
}