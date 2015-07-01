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
class user extends model {
    public function get($db, $data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "user WHERE user_id=" . $data['user_id'];

        $result = $db->query($sql);

        return $result->rows[0];
    }

    public function get_by_email($db, $email) {
        $sql = "SELECT * FROM " . DB_PREFIX . "user WHERE email='" . $email . "'";

        $result = $db->query($sql);

        return $result->rows[0];
    }
    
    public function login($db, $data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "user WHERE email='" . $data['email'] . "' AND password='" . md5($data['password']) . "'";

        $result = $db->query($sql);

        return $result->rows[0];
    }

    public function get_list($db, $data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "user";

        if(isset($data['orderby'])) {
            $sql = $sql . " ORDER BY " . $data['orderby'];
            if(isset($data['order'])) {
                $sql = $sql . " ASC";
            } else {
                $sql = $sql . " DESC";
            }
        } else {
            $sql = $sql . " ORDER BY user_id DESC";
        }

        if(isset($data['page'])) {
            $sql = $sql . " LIMIT " . ($data['page'] - 1) * 50 . ",50";
        } else {
            $sql = $sql . " LIMIT 0,50";
        }

        $result = $db->query($sql);

        return $result->rows;
    }

    public function get_list_count($db, $data) {
        $sql = "SELECT COUNT(*) AS count FROM " . DB_PREFIX . "user";

        $result = $db->query($sql);

        return $result->rows[0]['count'];
    }

    public function insert($db, $data) {
        $sql = "INSERT INTO " . DB_PREFIX . "user (user_id,email,password,title,first_name,last_name,billing_address_id,shipping_address_id,level,create_date,create_ip) VALUES ('"
            . $data['user_id'] . "','"
            . $data['email'] . "','"
            . md5($data['password']) . "','"
            . $data['title'] . "','"
            . $data['first_name'] . "','"
            . $data['last_name'] . "','"
            . $data['billing_address_id'] . "','"
            . $data['shipping_address_id'] . "','"
            . $data['level'] . "',"
            . "now(),'"
            . $data['create_ip'] . "')";

        return $db->query($sql);
    }

    public function update($db, $data) {
        if(strlen($data['password'])) {
            $sql = "UPDATE " . DB_PREFIX . "user SET "
                . "user_id='" . $data['user_id'] . "',"
                . "email='" . $data['email'] . "',"
                . "title='" . $data['title'] . "',"
                . "first_name='" . $data['first_name'] . "',"
                . "last_name='" . $data['last_name'] . "',"
                . "billing_address_id='" . $data['billing_address_id'] . "',"
                . "shipping_address_id='" . $data['shipping_address_id'] . "',"
                . "level='" . $data['level'] . "' "
                . "WHERE user_id=" . $data['user_id'];
        } else {
            $sql = "UPDATE " . DB_PREFIX . "user SET "
                . "user_id='" . $data['user_id'] . "',"
                . "email='" . $data['email'] . "',"
                . "password='" . md5($data['password']) . "',"
                . "title='" . $data['title'] . "',"
                . "first_name='" . $data['first_name'] . "',"
                . "last_name='" . $data['last_name'] . "',"
                . "billing_address_id='" . $data['billing_address_id'] . "',"
                . "shipping_address_id='" . $data['shipping_address_id'] . "',"
                . "level='" . $data['level'] . "' "
                . "WHERE user_id=" . $data['user_id'];
        }

        return $db->query($sql);
    }

    public function delete($db, $data) {
        $sql = "DELETE FROM " . DB_PREFIX . "user WHERE user_id=" . $data['user_id'];

        return $db->query($sql);
    }
}
?>
