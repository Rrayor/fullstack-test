<?php

    $auth = isset($_SESSION['id']) && !empty($_SESSION['id']);

    function get($auth) {
        if(!$auth) {
            view('login');
            return;
        }
    
        redirect('/list');
    }

    function post($auth) {
        if(!$auth) {
            require_once('./controllers/login.php');
            view('login');
            return;
        }
    
        redirect('/list');
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        post($auth);
    } else {
        get($auth);
    }

?>