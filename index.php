<?php
    session_start();

    require_once('db_config.php');

    $base_uri = 'fullstack-test';

    $db = new DB();
    $conn = $db->getConn();

    if($conn === null) {
        echo 'Error';
    }

    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }

    function view($file) {
        include_once('./views/components/head.php');
        include_once('./views/components/nav.php');
        include_once('./views/' . $file . '.php');
        include_once('./views/components/foot.php');
    }

    $request_uri = explode($base_uri, $_SERVER['REQUEST_URI'], 2);
    if(count($request_uri) > 1) {
        $request_uri = explode('?', $request_uri[1], 2);
    }
    
    switch ($request_uri[0]) {
        case '/':
            view('home');
            break;
        case '/login':
            if(!isset($_SESSION['id']) || empty($_SESSION['id'])) {
                require_once('./controllers/login.php');
                view('login');
                break;
            }

            redirect('/list');
            break;
        case '/list':
            if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
                require_once('./controllers/list.php');
                if($_SERVER['REQUEST_METHOD'] === 'GET') {
                    view('list');
                }
                break;
            }

            redirect('/login');
            break;
        case '/logout':
            session_unset();
            session_destroy();
            redirect('/');
            break;
        default:
            header('HTTP/1.0 404 Not Found');
            require '../views/404.php';
            break;
    }

?>