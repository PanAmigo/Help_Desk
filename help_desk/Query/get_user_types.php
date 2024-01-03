<?php
    session_start();
    include (__DIR__.'/../Config/Database_config.php');
    $query = "SELECT * FROM User_type";
    $data_types = $link->query($query);
    $data_types2 = $link->query($query);
?>