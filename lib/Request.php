<?php

namespace lib;

class Request {

    public $default_controller = '';

    public $default_action = '';

    public $default_params = [];

    public $baseUrl;

    public function __construct()
    {
        $this->baseUrl = $this->getBaseUrl();
    }

    public function getBaseUrl()
    {
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        
        return $this->getProtocol().$this->getHostName().$pathInfo['dirname']."/";
    }

    public function getProtocol()
    {
        return App::isSSL()?'https://':'http://';
    }

    public function getHostName()
    {
        return $_SERVER['HTTP_HOST'];
    }

    public function getCurrentUrl()
    {
        return $this->getBaseUrl().($_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '');
    }

    public function redirect($url)
    {
        header('Location: '.$url);
    }

    public function resolve()
    {
        $get = $_GET;
        if (!empty($get['action'])) {
            $action_params = explode('/', $get['action']);
            $controller = $action_params[0];
            $action = (!empty($action_params[1]) ? $action_params[1] : $this->default_action);
            $params = (!empty($action_params[2]) ? $action_params[2] : $this->default_params);
            unset($get['action']);
        }else{
            $controller = $this->default_controller;
            $action = $this->default_action;
            $params = $this->default_params;    
        }
        return [$controller, $action, $params];
    }

    public function createLink($controller, $action = false, $id = false)
    {
        return $this->baseUrl.'?action='.$controller.($action !== false ? '/'.$action.($id !== false ? '/'.$id : '') : '' );
    }

    public function isAjax()
    {
        return $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

}