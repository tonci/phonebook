<?php

namespace lib;

class Request {

    public function resolve()
    {
        return ['user', '', ['id'=>1, 'name'=>2]];
    }

}