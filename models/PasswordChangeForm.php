<?php

namespace models;
use lib\App;

class PasswordChangeForm extends \lib\FormModel {
    public $password;
    public $new_password;
    protected $_user;

    public function validate()
    {
        $user = $this->getUser();
        if (!$user->validatePassword($this->password)) $this->addError('password', 'Current password is invalid.');

        if ($this->password == $this->new_password) $this->addError('new_password', 'New Password should be different than the old one.');

        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,60}$/', $this->new_password)) $this->addError('new_password', 'Password should contain at least one digit, at least one letter and should be between 8 and 60 characters');

        return !$this->hasErrors();
    }

    public function change()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $user->password = $this->new_password;
            
            if (!$user->save()) {
                $this->_errors += $user->getErrors();
            }
            
        }
        return !$this->hasErrors();
    }

    public function getUser()
    {
        
        // if ($this->_user === false) {
            $this->_user = (new User)->findByUsername(App::getComponent('user')->getUsername())[0];

        // }

        return $this->_user;
    }
}