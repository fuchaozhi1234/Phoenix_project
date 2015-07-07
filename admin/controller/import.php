<?php
require_once MODEL_DIR . 'model/waybill.php';
require_once MODEL_DIR . 'model/log.php';
require_once MODEL_DIR . 'model/courier.php';
require_once 'library/PHPExcel.php';

class import_controller extends controller {
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
        $this->load("waybill/import");
    }

    public function upload() {
        if($this->request->server['REQUEST_METHOD'] == "POST") {
			$filename = "../uploads/csv/" . $this->request->files["csv"]["name"];
			if (!file_exists($filename)) {
				move_uploaded_file($this->request->files["csv"]["tmp_name"], $filename);
			} else {
				unlink($filename);
				move_uploaded_file($this->request->files["csv"]["tmp_name"], $filename);
			}

			$objPHPExcel = PHPExcel_IOFactory::load($filename);

			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
				$worksheetTitle     = $worksheet->getTitle();
				$highestRow         = $worksheet->getHighestRow();

				for ($row = 2; $row <= $highestRow; ++ $row) {
					$waybill = array(
						'tracking_number' => $worksheet->getCellByColumnAndRow(0, $row)->getValue(),
						'sender_name' => $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
						'sender_phone' => $worksheet->getCellByColumnAndRow(2, $row)->getValue(),
						'sender_address' => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),
						'sender_country' => $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
						'receiver_name' => $worksheet->getCellByColumnAndRow(5, $row)->getValue(),
						'receiver_identity' => $worksheet->getCellByColumnAndRow(6, $row)->getValue(),
						'receiver_phone' => $worksheet->getCellByColumnAndRow(7, $row)->getValue(),
						'receiver_address' => $worksheet->getCellByColumnAndRow(8, $row)->getValue(),
						'receiver_country' => $worksheet->getCellByColumnAndRow(9, $row)->getValue(),
						'order_date' => $worksheet->getCellByColumnAndRow(10, $row)->getValue(),
						'weight' => $worksheet->getCellByColumnAndRow(11, $row)->getValue(),
						'postage' => $worksheet->getCellByColumnAndRow(12, $row)->getValue(),
						'insurance' => $worksheet->getCellByColumnAndRow(13, $row)->getValue(),
						'tax' => $worksheet->getCellByColumnAndRow(14, $row)->getValue(),
						'packing_charge' => $worksheet->getCellByColumnAndRow(15, $row)->getValue(),
						'total_price' => $worksheet->getCellByColumnAndRow(16, $row)->getValue(),
						'agent_number' => $worksheet->getCellByColumnAndRow(17, $row)->getValue(),
						'agent_price' => $worksheet->getCellByColumnAndRow(18, $row)->getValue(),
						'note' => $worksheet->getCellByColumnAndRow(19, $row)->getValue(),
						'courier_id' => $worksheet->getCellByColumnAndRow(20, $row)->getValue(),
						'transfer_tracking_number' => $worksheet->getCellByColumnAndRow(21, $row)->getValue(),
					);
					$tracking_number = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$id = $this->model_waybill->get_id_by_tracking_number($this->db, $tracking_number);
					if(!$id) {
						$this->model_waybill->insert($this->db, $waybill);
					} else {
						$waybill['id'] = $id;
						$this->model_waybill->update($this->db, $waybill);
					}
				}
			}
        }

		redirect_model("waybill");
    }

    public function dispatch() {
        switch($this->request->get["action"]) {
            case 'upload':
                $this->upload();
                break;

            default:
                $this->index();
                break;
        }
    }
}
?>
