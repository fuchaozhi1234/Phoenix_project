<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Wu
 */
require_once MODEL_DIR . 'model/user.php';

class user_controller extends controller {
    private $model_user;

    public function __construct($db, $request) {
        $this->init($db, $request);
        $this->model_user = new user();
    }

    public function index() {
        $this->get_form();
        $this->data['primary'] = 'user_id';
        $this->data['count'] = $this->model_user->get_list_count($this->db, null);
        $this->data['list'] = $this->model_user->get_list($this->db, $this->request->get);
        $this->data['page'] = isset($this->request->get['page']) ? pager($this->data['count'], "index.php?model=user", $this->request->get['page']) : pager($this->data['count'], "index.php?model=user");
        $this->load("user/user_list");
    }

    public function insert() {
        $this->data['title'] = "New user";
        $this->get_form();
        if($this->request->server['REQUEST_METHOD'] == "POST" && !$this->validate($this->request->post)) {
            $this->model_user->insert($this->db, $this->request->post);
            redirect_model("user");
        } else {
            $this->get_form();
            $this->load("user/user_form");
        }
    }

    public function update() {
        $this->data['title'] = "Update user";
        $this->get_form();
        if($this->request->server['REQUEST_METHOD'] == "POST" && !$this->validate($this->request->post, true)) {
            $this->model_user->update($this->db, $this->request->post);
            redirect_model("user");
        } else {
            $this->preload = $this->model_user->get($this->db, $this->request->get);
            $this->get_form();
            $this->load("user/user_form");
        }
    }

    public function delete() {
        if($this->request->server['REQUEST_METHOD'] == "GET" && !$this->validate($this->request->get, true)) {
            $this->model_user->delete($this->db, $this->request->get);
        }

        redirect_model("user");
    }

    private function get_form() {
        $single = array();
        $single['name'] = "User Id";
        $single['id'] = "user_id";
        $single['default'] = "";
        $single['type'] = "text";
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['user_id']) ? $this->request->post['user_id'] : $this->preload['user_id'];
        $this->data['form']['user_id'] = $single;

        $single = array();
        $single['name'] = "Email";
        $single['id'] = "email";
        $single['default'] = "";
        $single['type'] = "text";
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['email']) ? $this->request->post['email'] : $this->preload['email'];
        $this->data['form']['email'] = $single;

        $single = array();
        $single['name'] = "Password";
        $single['id'] = "password";
        $single['default'] = "";
        $single['type'] = "text";
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['password']) ? $this->request->post['password'] : $this->preload['password'];
        $this->data['form']['password'] = $single;

        $single = array();
        $single['name'] = "Title";
        $single['id'] = "title";
        $single['default'] = "";
        $single['type'] = "dropdown";
        $single['data'] = array(
            array('id' => 'Mr', 'name' => 'Mr'),
            array('id' => 'Mrs', 'name' => 'Mrs'),
            array('id' => 'Ms', 'name' => 'Ms'),
            array('id' => 'Miss', 'name' => 'Miss'),
            array('id' => 'Dr', 'name' => 'Dr'),
            array('id' => 'Prof', 'name' => 'Prof')
        );
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['title']) ? $this->request->post['title'] : $this->preload['title'];
        $this->data['form']['title'] = $single;

        $single = array();
        $single['name'] = "First Name";
        $single['id'] = "first_name";
        $single['default'] = "";
        $single['type'] = "text";
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['first_name']) ? $this->request->post['first_name'] : $this->preload['first_name'];
        $this->data['form']['first_name'] = $single;

        $single = array();
        $single['name'] = "Last Name";
        $single['id'] = "last_name";
        $single['default'] = "";
        $single['type'] = "text";
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['last_name']) ? $this->request->post['last_name'] : $this->preload['last_name'];
        $this->data['form']['last_name'] = $single;

        $single = array();
        $single['name'] = "Billing Address Id";
        $single['id'] = "billing_address_id";
        $single['default'] = "";
        $single['type'] = "text";
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['billing_address_id']) ? $this->request->post['billing_address_id'] : $this->preload['billing_address_id'];
        $this->data['form']['billing_address_id'] = $single;

        $single = array();
        $single['name'] = "Shipping Address Id";
        $single['id'] = "shipping_address_id";
        $single['default'] = "";
        $single['type'] = "text";
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['shipping_address_id']) ? $this->request->post['shipping_address_id'] : $this->preload['shipping_address_id'];
        $this->data['form']['shipping_address_id'] = $single;

        $single = array();
        $single['name'] = "Level";
        $single['id'] = "level";
        $single['default'] = "9";
        $single['type'] = "text";
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['level']) ? $this->request->post['level'] : $this->preload['level'];
        $this->data['form']['level'] = $single;

        $single = array();
        $single['name'] = "Create Date";
        $single['id'] = "create_date";
        $single['default'] = "";
        $single['type'] = "text";
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['create_date']) ? $this->request->post['create_date'] : $this->preload['create_date'];
        $this->data['form']['create_date'] = $single;

        $single = array();
        $single['name'] = "Create Ip";
        $single['id'] = "create_ip";
        $single['default'] = $this->request->server['REMOTE_ADDR'];
        $single['type'] = "text";
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['create_ip']) ? $this->request->post['create_ip'] : $this->preload['create_ip'];
        $this->data['form']['create_ip'] = $single;
    }

    public function dispatch() {
        switch($this->request->get["action"]) {
            case 'insert':
                $this->insert();
                break;

            case 'update':
                $this->update();
                break;

            case 'delete':
                $this->delete();
                break;

            default:
                $this->index();
                break;
        }
    }
}
?>
