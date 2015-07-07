<?php
require_once MODEL_DIR . 'model/uploads.php';

class uploads_controller extends controller {
    private $model_uploads;

    public function __construct($db, $request) {
        $this->init($db, $request);
        $this->model_uploads = new uploads();
    }

    public function index() {
        $this->get_form();
        $this->data['primary'] = 'id';
        $this->data['count'] = $this->model_uploads->get_list_count($this->db, null);
        $this->data['list'] = $this->model_uploads->get_list($this->db, $this->request->get);
        $this->data['page'] = isset($this->request->get['page']) ? pager($this->data['count'], "index.php?model=uploads", $this->request->get['page']) : pager($this->data['count'], "index.php?model=uploads");
        $this->load("uploads/list");
    }

    public function insert() {
        $this->data['title'] = "New uploads";
        $this->get_form();
        if($this->request->server['REQUEST_METHOD'] == "POST" && !$this->validate($this->request->post)) {
            $this->model_uploads->insert($this->db, $this->request->post);
            redirect_model("uploads");
        } else {
            $this->get_form();
            $this->load("uploads/form");
        }
    }

    public function update() {
        $this->data['title'] = "Update uploads";
        $this->get_form();
        if($this->request->server['REQUEST_METHOD'] == "POST" && !$this->validate($this->request->post, true)) {
            $this->model_uploads->update($this->db, $this->request->post);
            redirect_model("uploads");
        } else {
            $this->preload = $this->model_uploads->get($this->db, $this->request->get);
            $this->get_form();
            $this->load("uploads/form");
        }
    }

    public function delete() {
        if($this->request->server['REQUEST_METHOD'] == "GET" && !$this->validate($this->request->get, true)) {
            $this->model_uploads->delete($this->db, $this->request->get);
        }

        redirect($_SERVER["HTTP_REFERER"]);
    }
/*
    private function get_form() {
        $single = array();
        $single['name'] = "Id";
        $single['id'] = "id";
        $single['default'] = "";
        $single['type'] = "text";
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['id']) ? $this->request->post['id'] : $this->preload['id'];
        $this->data['form']['id'] = $single;

        $single = array();
        $single['name'] = "Name";
        $single['id'] = "name";
        $single['default'] = "";
        $single['type'] = "text";
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['name']) ? $this->request->post['name'] : $this->preload['name'];
        $this->data['form']['name'] = $single;

        $single = array();
        $single['name'] = "Identity";
        $single['id'] = "identity";
        $single['default'] = "";
        $single['type'] = "text";
        $single['list'] = false;
        $single['link'] = "";
        $single['primary'] = false;
        $single['null'] = true;
        $single['lock'] = false;
        $single['value'] = isset($this->request->post['identity']) ? $this->request->post['identity'] : $this->preload['identity'];
        $this->data['form']['identity'] = $single;
    }
*/
    private function get_form() {
        $this->data['form']['id'] = array(
			'name' => 'Id',
			'id' => 'id',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['id']) ? $this->request->post['id'] : $this->preload['id']
		);
        $this->data['form']['tracking_number'] = array(
			'name' => 'Tracking Number',
			'id' => 'tracking_number',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['tracking_number']) ? $this->request->post['tracking_number'] : $this->preload['tracking_number']
		);
        $this->data['form']['identity'] = array(
			'name' => 'Identity',
			'id' => 'identity',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['identity']) ? $this->request->post['identity'] : $this->preload['identity']
		);
        $this->data['form']['name'] = array(
			'name' => 'Name',
			'id' => 'name',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['name']) ? $this->request->post['name'] : $this->preload['name']
		);
        $this->data['form']['phone'] = array(
			'name' => 'Phone',
			'id' => 'phone',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['phone']) ? $this->request->post['phone'] : $this->preload['phone']
		);
        $this->data['form']['backside_photo'] = array(
			'name' => 'Backside Photo',
			'id' => 'backside_photo',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['backside_photo']) ? $this->request->post['backside_photo'] : $this->preload['backside_photo']
		);
        $this->data['form']['frontside_photo'] = array(
			'name' => 'Frontside Photo',
			'id' => 'frontside_photo',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['frontside_photo']) ? $this->request->post['frontside_photo'] : $this->preload['frontside_photo']
		);
        $this->data['form']['signature_photo'] = array(
			'name' => 'Signature Photo',
			'id' => 'signature_photo',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['signature_photo']) ? $this->request->post['signature_photo'] : $this->preload['signature_photo']
		);
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
