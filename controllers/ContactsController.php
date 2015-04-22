<?php

namespace controllers;

use models\Contact;
use lib\App;
use lib\helpers\DataGrid;

class ContactsController extends \lib\Controller {
    public function actionIndex()
    {
        $model = new Contact;

        if (!empty($_POST['Contact'])) {
            $model = new Contact;
            $model->user_id = App::getComponent('user')->getId();
            $model->full_name = $_POST['Contact']['full_name'];
            $model->email = $_POST['Contact']['email'];
            $model->phone = $_POST['Contact']['phone'];
            if ($model->save()) {
                $this->redirect('contacts');
                // set flash message
            }
        }

        $params['grid'] = (new DataGrid([
                'model' => $model,
                'update_url' => App::getComponent('request')->createLink('contacts', 'update'),
                'criteria' => [
                    'user_id' => App::getComponent('user')->getId(),
                ],
                'columns' => [
                    'full_name' => [
                        'alias' => 'Contact Name:',
                        'searchable' => true,
                    ],
                    'email' => [
                        'searchable' => true,
                    ],
                    'phone' => [
                        'searchable' => true,
                    ],
                    'actions' => [
                        'alias' => 'Actions:',
                        'content' => function($key, $data)
                            {
                                // this logic should be mevoed inside the grid and automatically gets the link
                                $url = App::getComponent('request')->createLink('contacts', 'delete', $data->id);
                                return '<td><a class="btn btn-danger btn-sm grid-delete" href="'.$url.'">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            Delete
                                        </a></td>';
                            },
                        'not_sortable' => true,
                    ]
                ]
            ]))->render();

        $params['model'] = $model;

        return $this->render('index', $params);
    }

    public function actionUpdate($id)
    {
        if (!empty($_POST['Contact'])) {
            $contact = (new Contact)->findById((int)$id)[0];
            if ($contact->user_id == App::getComponent('user')->getId()) {
                foreach ($_POST['Contact'] as $name => $value) {
                    if (isset($contact->$name)) {
                        $contact->$name = $value;
                    }
                }
                if ($contact->save()) {
                    return 1;
                }else{
                    print_r($contact->getErrors());
                }
            }
            exit;
        }
        $this->redirect('contacts');   
    }

    public function actionDelete($id)
    {
        $contact = (new Contact)->findById((int)$id)[0];
        $deleted = false;
        if ($contact->user_id == App::getComponent('user')->getId()) {
            $deleted = (boolean)$contact->delete();
        }
        if (App::getComponent('request')->isAjax()) {
            return $deleted;
        }
        $this->redirect('contacts');   
    }
}