<?php
require_once MODEL_DIR . 'model/waybill.php';
require_once MODEL_DIR . 'model/log.php';
require_once MODEL_DIR . 'model/courier.php';

class waybill_controller extends controller {
    private $model_waybill;
    private $model_log;
    private $model_courier;

    public function __construct($db, $request) {
        $this->init($db, $request);
        $this->model_waybill = new waybill();
        $this->model_log = new log();
        $this->model_courier = new courier();
    }

    public function index() {
        $this->get_form();
        $this->data['primary'] = 'id';
		$this->data['count'] = $this->model_waybill->get_list_count($this->db, $this->request->get);
		$this->data['list'] = $this->model_waybill->get_list($this->db, $this->request->get);
        $this->data['page'] = isset($this->request->get['page']) ? pager($this->data['count'], "index.php?model=waybill", $this->request->get['page']) : pager($this->data['count'], "index.php?model=waybill");
        $this->load("waybill/list");
    }

    public function insert() {
        $this->data['title'] = "New waybill";
        $this->get_form();
        if($this->request->server['REQUEST_METHOD'] == "POST" && !$this->validate($this->request->post)) {
            $this->model_waybill->insert($this->db, $this->request->post);
            redirect_model("waybill");
        } else {
            $this->get_form();
            $this->load("waybill/form");
        }
    }

    public function update() {
        $this->data['title'] = "Update waybill";
        $this->get_form();
        if($this->request->server['REQUEST_METHOD'] == "POST" && !$this->validate($this->request->post, true)) {
            $this->model_waybill->update($this->db, $this->request->post);
            redirect($_SERVER["HTTP_REFERER"]);
        } else {
            $this->data['log'] = $this->model_log->get_list_by_waybill($this->db, $this->request->get);
            $this->preload = $this->model_waybill->get($this->db, $this->request->get);
            $this->get_form();
            $this->load("waybill/form");
        }
    }

    public function delete() {
        if($this->request->server['REQUEST_METHOD'] == "GET" && !$this->validate($this->request->get, true)) {
            $this->model_waybill->delete($this->db, $this->request->get);
        }

        redirect($_SERVER["HTTP_REFERER"]);
    }

    public function log() {
        if($this->request->server['REQUEST_METHOD'] == "POST") {
            $this->model_log->insert($this->db, array(
					'waybill_id' => $this->request->post['waybill_id'],
					'tracking_number' => $this->request->post['tracking_number'],
					'content' => $this->request->post['content']
				)
			);
        }

        redirect($_SERVER["HTTP_REFERER"]);
    }

    public function delete_log() {
        if($this->request->get['log_id']) {
            $this->model_log->delete($this->db, array(
					'id' => $this->request->get['log_id']
				)
			);
        }

        redirect($_SERVER["HTTP_REFERER"]);
    }

    public function batch_delete() {
        if($this->request->server['REQUEST_METHOD'] == "POST") {
			foreach($this->request->post['select'] as $id) {
				$this->model_waybill->delete($this->db, array('id' => $id));
			}
        }

        redirect($_SERVER["HTTP_REFERER"]);
    }

    public function batch_log($content) {
        if($this->request->server['REQUEST_METHOD'] == "POST") {
			foreach($this->request->post['select'] as $id) {
				$tracking_number = $this->model_waybill->get_tracking_number_by_id($this->db, $id);
				
				$this->model_log->insert($this->db, array(
						'waybill_id' => $id,
						'tracking_number' => $tracking_number,
						'content' => $content
					)
				);
			}
        }

        redirect($_SERVER["HTTP_REFERER"]);
    }

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
			'lock' => true,
			'value' => isset($this->request->post['id']) ? $this->request->post['id'] : $this->preload['id']
		);
        $this->data['form']['tracking_number'] = array(
			'name' => '运单号',
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
        $this->data['form']['sender_name'] = array(
			'name' => '发件人',
			'id' => 'sender_name',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['sender_name']) ? $this->request->post['sender_name'] : $this->preload['sender_name']
		);
        $this->data['form']['sender_phone'] = array(
			'name' => '发件人电话',
			'id' => 'sender_phone',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['sender_phone']) ? $this->request->post['sender_phone'] : $this->preload['sender_phone']
		);
        $this->data['form']['sender_address'] = array(
			'name' => '发件人地址',
			'id' => 'sender_address',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['sender_address']) ? $this->request->post['sender_address'] : $this->preload['sender_address']
		);
        $this->data['form']['sender_country'] = array(
			'name' => '发件人国家',
			'id' => 'sender_country',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['sender_country']) ? $this->request->post['sender_country'] : $this->preload['sender_country']
		);
        $this->data['form']['receiver_name'] = array(
			'name' => '收件人',
			'id' => 'receiver_name',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['receiver_name']) ? $this->request->post['receiver_name'] : $this->preload['receiver_name']
		);
        $this->data['form']['receiver_identity'] = array(
			'name' => '收件人身份证号',
			'id' => 'receiver_identity',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['receiver_identity']) ? $this->request->post['receiver_identity'] : $this->preload['receiver_identity']
		);
        $this->data['form']['receiver_phone'] = array(
			'name' => '收件人电话',
			'id' => 'receiver_phone',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['receiver_phone']) ? $this->request->post['receiver_phone'] : $this->preload['receiver_phone']
		);
        $this->data['form']['receiver_address'] = array(
			'name' => '收件人地址',
			'id' => 'receiver_address',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['receiver_address']) ? $this->request->post['receiver_address'] : $this->preload['receiver_address']
		);
        $this->data['form']['receiver_country'] = array(
			'name' => '收件人国家',
			'id' => 'receiver_country',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['receiver_country']) ? $this->request->post['receiver_country'] : $this->preload['receiver_country']
		);
        $this->data['form']['order_date'] = array(
			'name' => '订单日期',
			'id' => 'order_date',
			'default' => '',
			'type' => 'date',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['order_date']) ? $this->request->post['order_date'] : $this->preload['order_date']
		);
        $this->data['form']['weight'] = array(
			'name' => '重量',
			'id' => 'weight',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['weight']) ? $this->request->post['weight'] : $this->preload['weight']
		);
        $this->data['form']['postage'] = array(
			'name' => '邮费',
			'id' => 'postage',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['postage']) ? $this->request->post['postage'] : $this->preload['postage']
		);
        $this->data['form']['insurance'] = array(
			'name' => '保险',
			'id' => 'insurance',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['insurance']) ? $this->request->post['insurance'] : $this->preload['insurance']
		);
        $this->data['form']['tax'] = array(
			'name' => '税款',
			'id' => 'tax',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['tax']) ? $this->request->post['tax'] : $this->preload['tax']
		);
        $this->data['form']['packing_charge'] = array(
			'name' => '包装费',
			'id' => 'packing_charge',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['packing_charge']) ? $this->request->post['packing_charge'] : $this->preload['packing_charge']
		);
        $this->data['form']['total_price'] = array(
			'name' => '总价',
			'id' => 'total_price',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['total_price']) ? $this->request->post['total_price'] : $this->preload['total_price']
		);
        $this->data['form']['agent_number'] = array(
			'name' => '代理号',
			'id' => 'agent_number',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['agent_number']) ? $this->request->post['agent_number'] : $this->preload['agent_number']
		);
        $this->data['form']['agent_price'] = array(
			'name' => '代理价格',
			'id' => 'agent_price',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['agent_price']) ? $this->request->post['agent_price'] : $this->preload['agent_price']
		);
        $this->data['form']['note'] = array(
			'name' => '备注',
			'id' => 'note',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['note']) ? $this->request->post['note'] : $this->preload['note']
		);
        $this->data['form']['courier_id'] = array(
			'name' => '转运快递',
			'id' => 'courier_id',
			'default' => '',
			'type' => 'dropdown',
			'data' => $this->model_courier->get_list($this->db, null),
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['courier_id']) ? $this->request->post['courier_id'] : $this->preload['courier_id']
		);
        $this->data['form']['transfer_tracking_number'] = array(
			'name' => '转运单号',
			'id' => 'transfer_tracking_number',
			'default' => '',
			'type' => 'text',
			'list' => false,
			'link' => '',
			'primary' => false,
			'null' => true,
			'lock' => false,
			'value' => isset($this->request->post['transfer_tracking_number']) ? $this->request->post['transfer_tracking_number'] : $this->preload['transfer_tracking_number']
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

            case 'log':
                $this->log();
                break;

            case 'delete_log':
                $this->delete_log();
                break;

            case 'batch_delete':
                $this->batch_delete();
                break;

            case 'batch_log_a':
                $this->batch_log("已入凤凰仓库");
                break;

            case 'batch_log_b':
                $this->batch_log("航班已起飞");
                break;

            case 'batch_log_c':
                $this->batch_log("航班已到达");
                break;

            case 'batch_log_d':
                $this->batch_log("等待海关清关");
                break;

            case 'batch_log_e':
                $this->batch_log("海关已清关");
                break;

            case 'batch_log_f':
                $this->batch_log("正在派送");
                break;

            case 'batch_log_g':
                $this->batch_log("收货人签收");
                break;

            default:
                $this->index();
                break;
        }
    }
}
?>
