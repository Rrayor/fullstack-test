<?php
    $lists = $_SESSION['response']['lists'];

    unset($_SESSION['response']['lists']);
?>
<section id="content">

    <div class="lists">
        <?php
            foreach($lists as $l_id => $list) {
                echo '<ul class="item-list" id="' . $l_id . '">';
                
                foreach($list as $item) {
                    echo '
                        <li class="draggable" draggable="true" id="' . $item['id'] . '">
                            '.
                                $item['text']
                            .'
                        </li>
                    ';
                }

                echo '</ul>';
            }
        ?>

    </div>

    <button class="submit-btn" id="save_lists">Save</button>
    <div class="error-message">

    </div>
    <script src="js/dist/list.js"></script>
</section>