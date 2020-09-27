<?php
    $auth = isset($_SESSION['id']) && !empty($_SESSION['id']);

    function get($auth) {
        if(!$auth) {
            redirect('/login');
            return;
        }
        
        require_once('./controllers/list.php');
        view('list');
    }

    function post($auth) {
        if(!$auth) {
            redirect('/login');
            return;
        }
        
        require_once('./controllers/list.php');
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        post($auth);
    } else {
        get($auth);
    }
?>