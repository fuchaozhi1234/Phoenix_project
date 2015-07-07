<?php
class waybill extends model {
    public function get($db, $data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "waybill WHERE id=" . $data['id'];

        $result = $db->query($sql);

        return $result->rows[0];
    }

    public function get_id_by_tracking_number($db, $tracking_number) {
        $sql = "SELECT id FROM " . DB_PREFIX . "waybill WHERE tracking_number='" . $tracking_number . "'";

        $result = $db->query($sql);
		
		if(isset($result->rows[0]['id'])) {
			return $result->rows[0]['id'];
		} else {
			return false;
		}
    }

    public function get_tracking_number_by_id($db, $id) {
        $sql = "SELECT tracking_number FROM " . DB_PREFIX . "waybill WHERE id='" . $id . "'";

        $result = $db->query($sql);
		
		if(isset($result->rows[0]['tracking_number'])) {
			return $result->rows[0]['tracking_number'];
		} else {
			return false;
		}
    }

    public function get_list($db, $data) {
        $sql = "SELECT *,
		(SELECT COUNT(*) FROM uploads WHERE tracking_number=waybill.tracking_number) AS uploaded,
		(SELECT `identity` FROM uploads WHERE tracking_number=waybill.tracking_number LIMIT 1) AS identity,
		(SELECT `content` FROM log WHERE tracking_number=waybill.tracking_number ORDER BY id DESC LIMIT 1) AS status
		FROM " . DB_PREFIX . "waybill";
		
		if(isset($data['keyword']) && !empty($data['keyword'])) {
			$sql = $sql . " WHERE tracking_number LIKE '%{$data['keyword']}%' OR sender_name LIKE '%{$data['keyword']}%' OR receiver_name LIKE '%{$data['keyword']}%' OR receiver_identity LIKE '%{$data['keyword']}%'";
		}
		
        if(isset($data['orderby'])) {
            $sql = $sql . " ORDER BY " . $data['orderby'];
            if(isset($data['order'])) {
                $sql = $sql . " ASC";
            } else {
                $sql = $sql . " DESC";
            }
        } else {
			$sql = $sql . " ORDER BY id DESC";
		}

        if(isset($data['page'])) {
            $sql = $sql . " LIMIT " . ($data['page'] - 1) * 50 . ",50";
        } else {
			$sql = $sql . " LIMIT 50";
		}

        $result = $db->query($sql);

        return $result->rows;
    }

    public function get_list_count($db, $data) {
        $sql = "SELECT COUNT(*) AS count FROM " . DB_PREFIX . "waybill";

		if(isset($data['keyword']) && !empty($data['keyword'])) {
			$sql = $sql . " WHERE tracking_number LIKE '%{$data['keyword']}%' OR sender_name LIKE '%{$data['keyword']}%' OR receiver_name LIKE '%{$data['keyword']}%' OR receiver_identity LIKE '%{$data['keyword']}%'";
		}

        $result = $db->query($sql);

        return $result->rows[0]['count'];
    }

    public function get_all($db) {
        $sql = "SELECT * FROM " . DB_PREFIX . "waybill ORDER BY id DESC";

        $result = $db->query($sql);

        return $result->rows;
    }

    public function insert($db, $data) {
        $sql = "INSERT INTO " . DB_PREFIX . "waybill (courier_id,tracking_number,sender_name,sender_phone,sender_address,sender_country,receiver_name,receiver_identity,receiver_phone,receiver_address,receiver_country,order_date,weight,postage,insurance,tax,packing_charge,total_price,agent_number,agent_price,note,transfer_tracking_number) VALUES ('"
            . $data['courier_id'] . "','"
            . $data['tracking_number'] . "','"
            . $data['sender_name'] . "','"
            . $data['sender_phone'] . "','"
            . $data['sender_address'] . "','"
            . $data['sender_country'] . "','"
            . $data['receiver_name'] . "','"
            . $data['receiver_identity'] . "','"
            . $data['receiver_phone'] . "','"
            . $data['receiver_address'] . "','"
            . $data['receiver_country'] . "','"
            . $data['order_date'] . "','"
            . $data['weight'] . "','"
            . $data['postage'] . "','"
            . $data['insurance'] . "','"
            . $data['tax'] . "','"
            . $data['packing_charge'] . "','"
            . $data['total_price'] . "','"
            . $data['agent_number'] . "','"
            . $data['agent_price'] . "','"
            . $data['note'] . "','"
            . $data['transfer_tracking_number'] . "')";

        return $db->query($sql);
    }

    public function update($db, $data) {
        $sql = "UPDATE " . DB_PREFIX . "waybill SET "
            . "courier_id='" . $data['courier_id'] . "',"
            . "tracking_number='" . $data['tracking_number'] . "',"
            . "sender_name='" . $data['sender_name'] . "',"
            . "sender_phone='" . $data['sender_phone'] . "',"
            . "sender_address='" . $data['sender_address'] . "',"
            . "sender_country='" . $data['sender_country'] . "',"
            . "receiver_name='" . $data['receiver_name'] . "',"
            . "receiver_identity='" . $data['receiver_identity'] . "',"
            . "receiver_phone='" . $data['receiver_phone'] . "',"
            . "receiver_address='" . $data['receiver_address'] . "',"
            . "receiver_country='" . $data['receiver_country'] . "',"
            . "order_date='" . $data['order_date'] . "',"
            . "weight='" . $data['weight'] . "',"
            . "postage='" . $data['postage'] . "',"
            . "insurance='" . $data['insurance'] . "',"
            . "tax='" . $data['tax'] . "',"
            . "packing_charge='" . $data['packing_charge'] . "',"
            . "total_price='" . $data['total_price'] . "',"
            . "agent_number='" . $data['agent_number'] . "',"
            . "agent_price='" . $data['agent_price'] . "',"
            . "note='" . $data['note'] . "',"
            . "transfer_tracking_number='" . $data['transfer_tracking_number'] . "' "
            . "WHERE id=" . $data['id'];

        return $db->query($sql);
    }

    public function delete($db, $data) {
        $sql = "DELETE FROM " . DB_PREFIX . "waybill WHERE id=" . $data['id'];

        return $db->query($sql);
    }
}
?>
