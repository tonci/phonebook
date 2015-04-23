<?php

namespace models;

class Contact extends \lib\Model {
    protected $_entityTable = 'contacts';

    public function beforeSave()
    {
        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = str_replace(' ', '', htmlspecialchars(strip_tags($this->phone)));

        return $this->validate();
    }

    public function validate()
    {
        preg_match_all('/[\w-]+/u', $this->full_name, $name_parts);

        if (mb_strlen(implode('',$name_parts[0]), 'UTF-8') < 4) $this->addError('full_name', 'Full name must contain at least 4 characters');

        foreach ($name_parts[0] as $name) {
            if (mb_strlen($name, 'UTF-8') < 2){
                $this->addError('full_name', 'Each part of the name must be at least 2 characters long');
                break;
            }
        }

        @$another_contact = (new Contact)->findByFull_name($this->full_name)[0];
        if (!empty($another_contact) && $another_contact->id != $this->id) $this->addError('full_name', 'Full name is not unique');

        // by definition: http://en.wikipedia.org/wiki/E.164
        if (!preg_match('/^\+[1-9]\d{1,14}$/', $this->phone)) $this->addError('phone', 'Phone doesn`t match the E.164 pattern (should look like "+3593742734")');

        // regex used: http://www.regular-expressions.info/email.html
        if (!preg_match("/[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/", $this->email))
            $this->addError('email', 'Invalid Email address');

        return !$this->hasErrors();
    }
}