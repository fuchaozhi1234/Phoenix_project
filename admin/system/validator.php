<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validator
 *
 * @author Wu
 */
class validator {
    public function validate($value, $type) {
        switch($type) {
            case 'number':
                return filter_var($value, FILTER_VALIDATE_INT);

            case 'boolean':
                return ($value == 0 || $value == 1);

            case 'email':
                return filter_var($value, FILTER_VALIDATE_EMAIL);

            case 'float':
                return filter_var($value, FILTER_VALIDATE_FLOAT);

            case 'url':
                return filter_var($value, FILTER_VALIDATE_URL);

            case 'text':
                return true;

            default:
                return true;
        }
    }

    public function validate_int($value) {
        return true;
    }
}
?>