<?php

namespace lib;

class Request {

    public $default_controller = '';

    public $default_action = '';

    public $default_params = [];

    public function resolve()
    {
        $get = $_GET;
        if (!empty($get['action'])) {
            $action_params = explode('/', $get['action']);
            $controller = $action_params[0];
            $action = (!empty($action_params[1]) ? $action_params[1] : $this->default_action);
            unset($get['action']);
            $params = $get;
        }else{
            $controller = $this->default_controller;
            $action = $this->default_action;
            $params = $this->default_params;    
        }
        return [$controller, $action, $params];
    }

}