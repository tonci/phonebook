<?php

namespace lib;

class Controller {
    public $defaultAction = 'index';
    public $layout = 'main';
    public $layout_params = [];

    public function beforeAction($action)
    {
        if (App::getComponent('user')->isGuest() && (strtolower($this->getClassName()) != 'user' || !in_array($action, ['login', 'register']))) {
            $this->redirect('user', 'login');
            return false;
        }

        if (!empty($_POST) && !App::getComponent('user')->isGuest()) {
            if(@$_POST['csrf'] != App::getComponent('request')->getCSRF()){
                echo "Bad Request";
                exit;
            }
        }
        return true;
    }

    public function render($view, $params = [])
    {
        $layout_path = App::getViewPath().'/layouts/'.$this->layout.'.php';
        return App::getComponent('view')->render($layout_path, $this->layout_params+['content' => $this->renderPartial($view, $params)]);
    }

    public function renderPartial($view, $params = [])
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

    public function redirect($controller, $action = '')
    {
        header('Location: '.App::getComponent('request')->createLink($controller, $action));
        exit;
    }
}