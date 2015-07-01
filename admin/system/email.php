<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of email
 *
 * @author nothy
 */
class email {
    private $smtp_server;
    private $smtp_username;
    private $smtp_password;
    
    public function __construct() {
        $this->smtp_server = 'localhost';
        $this->smtp_username = '';
        $this->smtp_password = '';
    }

    public function send($to, $from, $subject, $content) {
        $headers = 'From: ' . $from . "\r\n" .
            'Reply-To: ' . $from;

        mail($to, $subject, $content, $headers);
    }
}
