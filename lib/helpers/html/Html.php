<?php

namespace lib\helpers\html;
use lib\App;

class Html {
    public static function createLink($controller, $action)
    {
        return App::getComponent('request')->createLink($controller, $action);
    }

    public static function textInput($model, $name, $params = [])
    {
        if (self::property_exists($model, $name)){
            $params['html_options']['name'] = $model->getClassName().'['.$name.']';
            $params['html_options']['type'] = 'text';
            if (!empty($model->$name)) $params['html_options']['value'] = $model->$name;
            if (!empty($_POST[$params['html_options']['name']])) $params['html_options']['value'] = $_POST[$params['html_options']['name']];
            return App::getComponent('view')->render(__DIR__.'/views/simpleInput.php', $params);
        }else{
            return '';
        }
    }

    public static function passwordInput($model, $name, $params = [])
    {
        if (self::property_exists($model, $name)){
            $params['html_options']['name'] = $model->getClassName().'['.$name.']';
            $params['html_options']['type'] = 'password';
            if (!empty($model->$name)) $params['html_options']['value'] = $model->$name;
            if (!empty($_POST[$params['html_options']['name']])) $params['html_options']['value'] = $_POST[$params['html_options']['name']];
            return App::getComponent('view')->render(__DIR__.'/views/simpleInput.php', $params);
        }else{
            return '';
        }
    }

    public static function beginForm($params = [])
    {   
        if (!empty($params['html_options'])) {
            $params['html_options'] = $params['html_options'] + ['action' => '', 'method' => 'post'];
        }
        $params['html_options'] = ['action' => '', 'method' => 'post'];
        $params['csrf'] = App::getComponent('request')->getCSRF();
        return App::getComponent('view')->render(__DIR__.'/views/beginForm.php', $params);
    }

    public static function endForm()
    {
        return App::getComponent('view')->render(__DIR__.'/views/endForm.php');
    }

    private static function property_exists($model, $name)
    {
        if (!isset($model->$name) && !property_exists($model, $name)) {
            throw new \InvalidArgumentException("Model: '".$model->getClassName()."' has no '$name' property defined");
            return false;
        }
        return true;
    }
}