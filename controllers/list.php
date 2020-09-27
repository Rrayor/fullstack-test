<?php
    require_once('db_config.php');
    require_once('db_util.php');

    function sanitizeString($str) {
        $str = trim($str);
        return htmlspecialchars($str);
    }

    function validateListItemData($id, $text, $list_id, $position) {
        $id = sanitizeString($id);
        $text = sanitizeString($text);
        $list_id = sanitizeString($list_id);
        $position = sanitizeString($position);

        $maxTextLength = 255;
        $maxPosition = 12;

        $errors = array();
        
        $uuidv4_pattern = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';

        if(
            (
                strlen($id) !== 32 &&
                strlen($id) !== 36
            ) ||
            !preg_match($uuidv4_pattern, $id)
        ) {
            $errors['err_id'] = 'Internal Error';
        }

        if(
            empty($text) ||
            strlen($text) >= $maxTextLength
        ) {
            $errors['err_text'] = 'Invalid text';
        }

        if(
            (
                strlen($id) !== 32 &&
                strlen($id) !== 36
            ) ||
            !preg_match($uuidv4_pattern, $list_id)
        ) {
            $errors['err_list_id'] = 'Internal Error';
        }

        if(
            !is_numeric($position) ||
            $position < 1 ||
            $position > $maxPosition
        ) {
            echo $position;
            $errors['err_position'] = 'Internal Error';
        }

        return $errors;
    }

    function update($conn, $item) {
        $stmt = $conn->prepare("UPDATE list_item SET position=?, list_id=? WHERE id=?");
        $stmt->bind_param('iss', $item->position, $item->list_id, $item->id);
        $stmt->execute();
    }

    function updateItems($conn, $items) {
        $errors = array();
        if(!$items || empty($items)) {
            $errors['err_server'] = 'Internal Error';
            return $errors;
        }

        foreach($items as $item) {
            $errors = validateListItemData($item->id, $item->text, $item->list_id, $item->position);
            if(!empty($errors)) {
                return $errors;
            }
        }

        foreach($items as $item) {
            update($conn, $item);
        }

        return $errors;
    }

    function buildErrorArray($response) {
        $errors = array();

        if(isset($response['err_id']) && !empty($response['err_id'])) array_push($errors, $response['err_id']);
        if(isset($response['err_text']) && !empty($response['err_text'])) array_push($errors, $response['err_text']);
        if(isset($response['err_list_id']) && !empty($response['err_list_id'])) array_push($errors, $response['err_list_id']);
        if(isset($response['err_position']) && !empty($response['err_position'])) array_push($errors, $response['err_position']);
        if(isset($response['err_server']) && !empty($response['err_server'])) array_push($errors, $response['err_server']);

        return $errors;
    }

    function getLists($conn) {
        $stmt = $conn->prepare("SELECT list.id AS l_id, list_item.id, list_item.text, list_item.list_id, list_item.position FROM list LEFT JOIN list_item ON list.id=list_item.list_id ORDER BY list_item.position ASC");
        $stmt->execute();

        $sql_result = $stmt->get_result();
        $result = array();

        while($item = $sql_result->fetch_assoc()) {
            if(!isset($result[$item['l_id']])) {
                $result[$item['l_id']] = array();
            }

            array_push($result[$item['l_id']], array(
                'id' => $item['id'],
                'text' => $item['text'],
                'list_id' => $item['list_id'],
                'position' => $item['position']
                )
            );
        }
        
        $_SESSION['response']['lists'] = $result;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = setupConn(isset($conn) ? $conn : null);

        $items = json_decode($_POST['items']);

        $response = updateItems($conn, $items);
        
        $errors = buildErrorArray($response);

        echo json_encode(array('errors' => $errors));
    } else if($_SERVER['REQUEST_METHOD'] === 'GET') {
        $conn = setupConn(isset($conn) ? $conn : null);

        getLists($conn);
    }
?>