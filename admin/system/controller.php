<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller
 *
 * @author Wu
 */
class controller {
    protected $request;
    protected $validator;
    protected $preload;
    protected $db;
    protected $data;

    protected function init($db, $request) {
        $this->db = $db;
        $this->request = $request;
        $this->validator = new validator();
    }

    protected function validate($values, $primary = false) {
        $this->data['error'] = array();
        $keys = array_keys($this->data['form']);

        foreach($keys as $key) {
            if(!isset($this->data['form'][$key])) {
                continue;
            }

            if($primary && $this->data['form'][$key]['primary'] && empty($values[$key])) {
                array_push($this->data['error'], $this->data['form'][$key]['name'] . " is required.");
            }

            if(!$this->data['form'][$key]['null'] && empty($values[$key])) {
                array_push($this->data['error'], $this->data['form'][$key]['name'] . " is required.");
            }

            if(!$this->validator->validate($values[$key], $this->data['form'][$key]['type'])) {
                array_push($this->data['error'], $this->data['form'][$key]['name'] . " is not correct.");
            }
        }

        if(sizeof($this->data['error'])) {
            $_SESSION['error'] = $this->data['error'];
            return true;
        } else {
            return false;
        }
    }

    protected function load($template, $clear = false) {
        if(!$clear) {
            require_once ADMIN_TEMPLATE_PATH . "common/header.php";
        }

        require_once ADMIN_TEMPLATE_PATH . $template . ".php";

        if(!$clear) {
            require_once ADMIN_TEMPLATE_PATH . "common/footer.php";
        }
    }
}
