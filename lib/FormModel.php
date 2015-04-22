<?php

namespace lib;

class FormModel {

    public $_errors = [];

    public function __construct()
    {

    }

    public function getClassName()
    {
        return preg_replace('/^models\\\(.*)$/', '$1', get_class($this));
    }

    public function __isset($name)
    {
        return isset($this->{$name});
    }

    public function hasError($name)
    {
        return !empty($this->_errors[$name]);
    }

    public function hasErrors()
    {
        return !empty($this->_errors);
    }

    public function getError($name)
    {
        if (!empty($this->_errors[$name])) {
            return implode(',<br />', $this->_errors[$name]);
        }
        return '';
    }

    public function getErrors($name='')
    {
        if (empty($name)) {
            return $this->_errors;
        }else{
            if (!empty($this->_errors[$name])) {
                return $this->_errors[$name];
            }else{
                return [];
            }
        }
    }

    public function addError($name, $error)
    {
        $this->_errors[$name][] = $error;
    }
}