<?php
    $data = $_REQUEST['in'];
    if ($data!='') {
        $hash = hash("sha256",$data);
        $_SESSION[$data] = $hash;
        echo $hash;
    }
?>