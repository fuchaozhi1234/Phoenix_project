<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of db
 *
 * @author Wu
 */
class db {
    private $link;

    public function __construct($hostname, $username, $password, $database) {
        $this->link = new mysqli($hostname, $username, $password, $database);

        if (mysqli_connect_error()) {
            throw new ErrorException('Error: Could not make a database link (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }

        $this->link->set_charset("utf8");
        $this->link->query("SET SQL_MODE = ''");
    }

    public function query($sql) {
        $query = $this->link->query($sql);

        if (!$this->link->errno){
            if (isset($query->num_rows)) {
                $data = array();

                while ($row = $query->fetch_assoc()) {
                        $data[] = $row;
                }

                $result = new stdClass();
                $result->num_rows = $query->num_rows;
                $result->row = isset($data[0]) ? $data[0] : array();
                $result->rows = $data;

                unset($data);

                $query->close();

                return $result;
            } else{
                return true;
            }
        } else {
            throw new ErrorException('Error: ' . $this->link->error . '<br />Error No: ' . $this->link->errno . '<br />' . $sql);
        }
    }

    public function escape($value) {
        return $this->link->real_escape_string($value);
    }

    public function count_affected() {
        return $this->link->affected_rows;
    }

    public function get_last_id() {
        return $this->link->insert_id;
    }

    public function __destruct() {
        $this->link->close();
    }
}
?>