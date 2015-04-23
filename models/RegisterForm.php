<?php

namespace models;

class RegisterForm extends \lib\FormModel {
    public $username;
    public $password;
    public $password_repeat;

    public function validate()
    {
        $ok = true;
        if (!preg_match('/^[a-zA-Z0-9_-]{3,60}$/', $this->username))
        {
            $this->addError('username', 'Username shuld be from 3 to 60 characters containing only (a-z,A-Z,0-9,_,-)'); 
            $ok = false;
        }elseif((new User)->findByUsername($this->username)){
            $this->addError('username', "Username: '{$this->username}' is already taken"); 
            $ok = false;
        }
        if ($this->password != $this->password_repeat){
            $this->addError('password_repeat', 'Repeat Password doesn`t match Password');
            $ok = false;
        } 
        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,60}$/', $this->password)){
            $this->addError('password', 'Password should contain at least one digit, at least one letter and should be between 8 and 60 characters');
            $ok = false;
        } 

        return $ok;
    }

    public function register()
    {
        $this->username = htmlspecialchars(strip_tags($this->username));
        if ($this->validate()) {
            $user = new User;
            $user->username = $this->username;
            $user->password = $this->password;

            
            if ($user->save()) {
                return true;
            }else{
                // print_r($user->getErrors());
                $this->_errors += $user->getErrors();
                return false;
            }
            
        }
        return false;
    }
}