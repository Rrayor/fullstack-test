<?php
    function setupConn($conn) {
        if(!isset($conn) ||  !is_object($conn)) {
            if(!isset($db)) {
                $db = new DB();
            }

            $conn = $db->getConn();
        }

        return $conn;
    }
?>