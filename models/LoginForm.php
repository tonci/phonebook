<?php

namespace models;
use lib\App;

class LoginForm extends \lib\FormModel {
    public $username;
    public $password;

    private $_user = false;

    public function validate()
    {
        $ok = true;
        if (empty($this->username)) {
            $this->addError('username', 'Username is required'); 
            $ok = false;
        }

        if (empty($this->password)) {
            $this->addError('password', 'Password is required'); 
            $ok = false;
        }

        if ($ok) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                // Show general message to prevent username/password enumerators
                $this->addError('username', 'Incorrect username or password.');
                $ok = false;
            }
        }

        return $ok;
    }

    public function login()
    {
        if ($this->validate()) {
            return App::getComponent('user')->login($this->getUser());
        }
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = (new User)->findByUsername($this->username)[0];
        }

        return $this->_user;
    }
}