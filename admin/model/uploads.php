<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of uploads
 *
 * @author Wu
 */
class uploads extends model {
    public function get($db, $data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "uploads";

        if(isset($data['id'])) {
            $sql = $sql . " WHERE id=" . $data['id'];
        }

        $result = $db->query($sql);

        return $result->rows[0];
    }

    public function get_list_count($db, $data) {
        $sql = "SELECT count(*) AS count FROM " . DB_PREFIX . "uploads";

        $result = $db->query($sql);

        return $result->rows[0]['count'];
    }

    public function get_list($db, $data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "uploads";

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
        } else {
            $sql = $sql . " LIMIT 0,50";
        }

        $result = $db->query($sql);

        return $result->rows;
    }

    public function insert($db, $data) {
        $sql = "INSERT INTO " . DB_PREFIX . "uploads (name,identity,frontside_photo,backside_photo) VALUES ('"
            . $data['name'] . "','"
            . $data['identity'] . "','"
            . $data['frontside_photo'] . "','"
            . $data['backside_photo'] . "')";

        return $db->query($sql);
    }

    public function update($db, $data) {
        $sql = "UPDATE " . DB_PREFIX . "uploads SET "
            . "name='" . $data['name'] . "',"
            . "identity='" . $data['identity'] . "',"
            . "frontside_photo='" . $data['frontside_photo'] . "',"
            . "backside_photo='" . $data['backside_photo'] . "' "
            . "WHERE id=" . $data['id'];

        return $db->query($sql);
    }

    public function delete($db, $data) {
        $sql = "DELETE FROM " . DB_PREFIX . "uploads WHERE id=" . $data['id'];

        return $db->query($sql);
    }
}
?>
