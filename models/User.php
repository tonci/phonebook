<?php

namespace models;

class User extends \lib\Model {
    protected $_entityTable = 'users';

    public function beforeSave()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return true;
    }

    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }
}