<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author nothy
 */
require_once MODEL_DIR . 'model/user.php';

class login_controller extends controller {
    private $model_user;

    public function __construct($db, $request) {
        $this->init($db, $request);
        $this->model_user = new user();
    }
    
    private function index() {
        $this->load("common/login", true);
    }

    public function login() {
        if(isset($this->request->post['email']) && isset($this->request->post['password'])) {
            $result = $this->model_user->login($this->db, $this->request->post);
            if($result != null) {
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['email'] = $result['email'];
                redirect_model("uploads");
            } else {
                $this->data['error'] = "用户名密码错误.";
                $this->load("common/login", true);
            }
        }
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['email']);

        redirect_model("login");
    }

    public function dispatch() {
        switch($this->request->get['action']) {
            case 'login':
                $this->login();
                break;

            case 'logout':
                $this->logout();
                break;

            default:
                $this->index();
                break;
        }
    }
}
