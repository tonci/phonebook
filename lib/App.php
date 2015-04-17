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

    public function handleRequest()
    {
        list($controllerName, $actionName, $params) = $this->getComponent('request')->resolve();
        $controllerName = $this->controllersNameSpace.'\\'.$controllerName.$this->controllerClassSuffix;
        $controller = new $controllerName;

        // todo check if controller exists
        // check if action exists

        if (empty($actionName)) $actionName = $controller->defaultAction;
        $actionName = $this->controllerActionPrefix.$actionName;
        return $controller->$actionName($params);
    }

    public function run()
    {
        // $product = new \models\Product;
        // $products = $product->findAll();
        echo $this->handleRequest();
        // echo $products[0]->product_name;
    }

    public function getComponent($name='')
    {
        if (!empty(self::$loadedComponents[$name])) {
            return self::$loadedComponents[$name];
        }else{
            return null;
        }
    }

    public static function getViewPath()
    {
        return __DIR__.'/../views';
    }

    public static function autoload($className='')
    {
        spl_autoload($className); 
    }
}

spl_autoload_register(['lib\\App', 'autoload'], true, true);