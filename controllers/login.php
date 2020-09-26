<?php
    require_once('db_config.php');

    function sanitizeString($str) {
        $str = trim($str);
        return htmlspecialchars($str);
    }

    function validateUserData($username, $password) {
        $maxUsernameLength = 255;
        $maxPasswordLength = 255;
        
        $errors = array();
        
        $username = sanitizeString($username);
        $password = sanitizeString($password);

        if(
            !$username ||
            strlen($username) <= 0 ||
            strlen($username > $maxUsernameLength)) {
            $errors['err_username'] = 'Username invalid';
        }

        if(
            !$password ||
            strlen($password) <= 0 ||
            strlen($password > $maxPasswordLength)) {
            $errors['err_password'] = 'Password invalid';
        }

        return $errors;
    }

    function login($conn, $username, $password) {
        $errors = validateUserData($username, $password);

        if(!empty($errors)) {
            return $errors;
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        
        
        $result = $stmt->get_result();
        
        if($result->num_rows <= 0) {
            $errors['err_password'] = 'Incorrect Username or Password';
            return $errors;
        }
        
        $user = $result->fetch_assoc();

        $password_match = password_verify($password, $user['password']);

        if(!$password_match) {
            $errors['err_password'] = 'Incorrect Username or Password';
            return $errors;
        }

        $_SESSION['username'] = $user['username'];
        $_SESSION['id'] = $user['id'];

        return array();
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(!isset($conn) ||  !is_object($conn)) {
            if(!isset($db)) {
                $db = new DB();
            }

            $conn = $db->getConn();
        }

        $_SESSION['response'] = login($conn, $_POST['username'], $_POST['password']);
        redirect('/list');
    }
?>