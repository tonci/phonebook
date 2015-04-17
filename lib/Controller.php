<?php

namespace lib;

class Controller {
    public $defaultAction = 'index';

    public function render($view, $params = [])
    {
        $view = App::getViewPath().'/'.strtolower($this->getClassName()).'/'.$view.'.php';
        return App::getComponent('view')->render($view, $params);
    }

    public function getClassName($fullName = false)
    {
        if (!$fullName) {
            return preg_replace('/^controllers\\\(.*)Controller$/', '$1', get_class($this));
        }else{
            return get_class($this);
        }
    }
}