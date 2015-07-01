<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function pager($count, $url, $current = 1) {
    $page['url'] = $url;
    $page['total'] = (int)($count / PAGE_SIZE + 1);
    $page['current'] = $current;
    $page['first'] = 1;
    $page['last'] = $page['total'];

    if($current > 1) {
        $page['previous'] = $current - 1;
    } else {
        $page['previous'] = 1;
    }

    if($current < $page['total']) {
        $page['next'] = $current + 1;
    } else {
        $page['next'] = $page['total'];
    }
    
    return $page;
}