<?php
/**
 * Created by PhpStorm.
 * User: GoMiNam
 * Date: 3/6/2018
 * Time: 10:31 AM
 * its call from bootstrap.php
 */
    // Simple page redirect
    function redirect($page){
        header('location: ' . URLROOT . '/' . $page);
    }