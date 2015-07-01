<?php
class courier extends model {
    public function get($db, $data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "courier WHERE id=" . $data['id'];

        $result = $db->query($sql);

        return $result->rows[0];
    }

    public function get_list($db, $data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "courier";

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

    public function get_list_count($db, $data) {
        $sql = "SELECT COUNT(*) AS count FROM " . DB_PREFIX . "courier";

        $result = $db->query($sql);

        return $result->rows[0]['count'];
    }

    public function insert($db, $data) {
        $sql = "INSERT INTO " . DB_PREFIX . "courier (name,code) VALUES ('"
            . $data['name'] . "','"
            . $data['code'] . "')";

        return $db->query($sql);
    }

    public function update($db, $data) {
        $sql = "UPDATE " . DB_PREFIX . "courier SET "
            . "name='" . $data['name'] . "',"
            . "code='" . $data['code'] . "' "
            . "WHERE id=" . $data['id'];

        return $db->query($sql);
    }

    public function delete($db, $data) {
        $sql = "DELETE FROM " . DB_PREFIX . "courier WHERE id=" . $data['id'];

        return $db->query($sql);
    }
}
?>