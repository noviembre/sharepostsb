<?php

/**
 * Created by PhpStorm.
 * User: GoMiNam
 * Date: 3/6/2018
 * Time: 10:45 AM
 */
session_start();
// Flash message helper
// EXAMPLE - flash('register_success', 'You are now registered');
// DISPLAY IN VIEW - echo flash('register_success');
//parametros de inicio $name, $message $class
    function flash($name = '', $message = '', $class = 'alert alert-success')
    {
        if (!empty($name)) {
            if (!empty($message) && empty($_SESSION[$name])) {
                if (!empty($_SESSION[$name])) {
                    unset($_SESSION[$name]);
                }

                if (!empty($_SESSION[$name . '_class'])) {
                    unset($_SESSION[$name . '_class']);
                }

                $_SESSION[$name] = $message;
                //la '_class'] va ser igual a la clase que le estan pasando;
                $_SESSION[$name . '_class'] = $class;
            } elseif (empty($message) && !empty($_SESSION[$name])) {
                $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
                echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_class']);
            }
        }
    }

    function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        } else {
            return false;
        }
    }


