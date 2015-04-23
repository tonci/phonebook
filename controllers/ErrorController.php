<?php

namespace controllers;

use lib\App;

class ErrorController extends \lib\Controller {
    public function action404()
    {
        $params['home_url'] = App::getComponent('request')->getBaseUrl();

        return $this->renderPartial('404', $params);
    }
}