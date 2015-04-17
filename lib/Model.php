<?php

namespace lib;

class Model extends \SimpleORM\ORM {
    public function __construct()
    {
        $this->_adapter = App::getComponent('db');
        parent::__construct();
    }
}