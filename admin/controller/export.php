<?php
require_once MODEL_DIR . 'model/waybill.php';
require_once MODEL_DIR . 'model/log.php';
require_once MODEL_DIR . 'model/courier.php';
require_once 'library/PHPExcel.php';

class export_controller extends controller {
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
        $this->load("waybill/export");
    }

    public function export() {
        if($this->request->server['REQUEST_METHOD'] == "GET") {
			date_default_timezone_set("Australia/Sydney");
			$objPHPExcel = new PHPExcel();
			$objProps = $objPHPExcel->getProperties();
			$header = array("运单号","发件人","发件人电话","发件人地址","发件人国家","收件人","收件人身份证号","收件人电话","收件人地址","收件人国家","订单日期","重量","邮费","保险","税款","包装费","总价","代理号","代理价格","备注","转运商代码","转运单号");
			$key = ord("A");
			foreach($header as $value){
				$colum = chr($key);
				$objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum . '1', $value);
				$key += 1;
			}

			$objActSheet = $objPHPExcel->getActiveSheet();
			
			$data = $this->model_waybill->get_all($this->db);

			$column = 2;
			foreach($data as $row){
				$objActSheet->setCellValue('A' . $column, $row['tracking_number']);
				$objActSheet->setCellValue('B' . $column, $row['sender_name']);
				$objActSheet->setCellValue('C' . $column, $row['sender_phone']);
				$objActSheet->setCellValue('D' . $column, $row['sender_address']);
				$objActSheet->setCellValue('E' . $column, $row['sender_country']);
				$objActSheet->setCellValue('F' . $column, $row['receiver_name']);
				$objActSheet->setCellValue('G' . $column, $row['receiver_identity']);
				$objActSheet->setCellValue('H' . $column, $row['receiver_phone']);
				$objActSheet->setCellValue('I' . $column, $row['receiver_address']);
				$objActSheet->setCellValue('J' . $column, $row['receiver_country']);
				$objActSheet->setCellValue('K' . $column, $row['order_date']);
				$objActSheet->setCellValue('L' . $column, $row['weight']);
				$objActSheet->setCellValue('M' . $column, $row['postage']);
				$objActSheet->setCellValue('N' . $column, $row['insurance']);
				$objActSheet->setCellValue('O' . $column, $row['tax']);
				$objActSheet->setCellValue('P' . $column, $row['packing_charge']);
				$objActSheet->setCellValue('Q' . $column, $row['total_price']);
				$objActSheet->setCellValue('R' . $column, $row['agent_number']);
				$objActSheet->setCellValue('S' . $column, $row['agent_price']);
				$objActSheet->setCellValue('T' . $column, $row['note']);
				$objActSheet->setCellValue('U' . $column, $row['courier_id']);
				$objActSheet->setCellValue('V' . $column, $row['transfer_tracking_number']);
				$column++;
			}

			$objPHPExcel->getActiveSheet()->setTitle('Export');
			$objPHPExcel->setActiveSheetIndex(0);

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="export.xlsx"');
			header('Cache-Control: max-age=0');
			$objWriter->save("php://output");
			exit;
		}
    }

    public function dispatch() {
        switch($this->request->get["action"]) {
            case 'export':
                $this->export();
                break;

            default:
                $this->index();
                break;
        }
    }
}
?>
