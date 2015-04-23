<?php

namespace lib;

class App {

    protected static $loadedComponents = [];

    protected $controllerActionPrefix = 'action';
    protected $controllerClassSuffix = 'Controller';
    protected $controllersNameSpace = 'controllers';

    public function __construct($config = []){
        $this->initComponents($config);
    }

    public function coreComponents()
    {
        // return [];
        return [
            'session' => ['class' => 'lib\Session'],
            'user' => ['class' => 'lib\User'],
            'request' => ['class' => 'lib\Request'],
            'view' => ['class' => 'lib\View'],
        ];
    }

    public function initComponents($config = [])
    {
        // merge core components with custom components
        foreach ($this->coreComponents() as $id => $component) {
            if (!isset($config['components'][$id])) {
                $config['components'][$id] = $component;
            } elseif (is_array($config['components'][$id]) && !isset($config['components'][$id]['class'])) {
                $config['components'][$id]['class'] = $component['class'];
            }
        }

        foreach ($config['components'] as $id => $properties) {
            self::$loadedComponents[$id] = new $properties['class']();
            $this->configureComponent(self::$loadedComponents[$id], $properties);
        }
    }

    public function configureComponent($object, $properties)
    {
        foreach ($properties as $name => $value) {
            if ($name != 'class')
                $object->$name = $value;
        }

        return $object;
    }

    public function showErrorPage()
    {
        header("HTTP/1.0 404 Not Found");
        $controllerName = $this->controllersNameSpace.'\\ErrorController';
        $controller = new $controllerName;
        return $controller->action404();
    }

    public function handleRequest()
    {
        list($controllerName, $actionName, $params) = $this->getComponent('request')->resolve();
        $controllerFullName = $this->controllersNameSpace.'\\'.ucfirst($controllerName).$this->controllerClassSuffix;

        if (!class_exists($controllerFullName) || strtolower($controllerName) == 'error'){
            return $this->showErrorPage();
        }
        $controller = new $controllerFullName;

        if (empty($actionName)) $actionName = $controller->defaultAction;
        $actionFullName = $this->controllerActionPrefix.$actionName;

        if (!method_exists($controller, $actionFullName)) {
            return $this->showErrorPage();
        }

        if ($controller->beforeAction($actionName)) {
            return $controller->$actionFullName($params);
        }else{
            $request = $this->getComponent('request');
            $request->redirect($request->getBaseUrl());
        }

    }

    public function run()
    {
        echo $this->handleRequest();
    }

    public static function getComponent($name='')
    {
        if (!empty(self::$loadedComponents[$name])) {
            return self::$loadedComponents[$name];
        }else{
            return null;
        }
    }

    public static function isSSL()
    {
        return strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https';
    }

    public static function getViewPath()
    {
        return __DIR__.'/../views';
    }

}
