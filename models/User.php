<?php

namespace models;

class User extends \lib\Model {
    protected $_entityTable = 'users';

    public function beforeSave()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->username = htmlspecialchars(strip_tags($this->username));
        return true;
    }

    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }
}