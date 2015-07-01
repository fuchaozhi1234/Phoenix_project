<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function redirect($url, $encode = true) {
    if($encode) {
        header("Location:" . htmlspecialchars_decode($url));
    } else {
        header("Location:" . $url);
    }
}

function redirect_model($model) {
    header("Location:index.php?model=" . $model);
}

function redirect_post($post_id) {
    header("Location:index.php?model=post&post_id=" . $post_id);
}
?>