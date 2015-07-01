<?php
class log extends model {
    public function get($db, $data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "log WHERE id=" . $data['id'];

        $result = $db->query($sql);

        return $result->rows[0];
    }

    public function get_list($db, $data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "log";

        if(isset($data['orderby'])) {
            $sql = $sql . " ORDER BY " . $data['orderby'];
            if(isset($data['order'])) {
                $sql = $sql . " ASC";
            } else {
                $sql = $sql . " DESC";
            }
        }

        if(isset($data['page'])) {
            $sql = $sql . " LIMIT " . ($data['page'] - 1) * 50 . ",50";
        }

        $result = $db->query($sql);

        return $result->rows;
    }

    public function get_list_by_waybill($db, $data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "log WHERE waybill_id=" . $data['id'] . " ORDER BY time ASC";

        $result = $db->query($sql);

        return $result->rows;
    }

    public function get_list_count($db, $data) {
        $sql = "SELECT COUNT(*) AS count FROM " . DB_PREFIX . "log";

        $result = $db->query($sql);

        return $result->rows[0]['count'];
    }

    public function insert($db, $data) {
        $sql = "INSERT INTO " . DB_PREFIX . "log (waybill_id,tracking_number,time,content) VALUES ('"
            . $data['waybill_id'] . "',(SELECT tracking_number FROM waybill WHERE id=" . $data['waybill_id'] . "),"
            . "now(),'"
            . $data['content'] . "')";

        return $db->query($sql);
    }

    public function update($db, $data) {
        $sql = "UPDATE " . DB_PREFIX . "log SET "
            . "waybill_id='" . $data['waybill_id'] . "',"
            . "tracking_number='" . $data['tracking_number'] . "',"
            . "time='" . $data['time'] . "',"
            . "content='" . $data['content'] . "' "
            . "WHERE id=" . $data['id'];

        return $db->query($sql);
    }

    public function delete($db, $data) {
        $sql = "DELETE FROM " . DB_PREFIX . "log WHERE id=" . $data['id'];

        return $db->query($sql);
    }
}
?>
