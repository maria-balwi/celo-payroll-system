<?php

    if (isset($_POST['id'])) {
        function globalVariable() {
            global $id;
            $id = $_POST['id'];
            echo $id;
        }
        return;
    }
?>