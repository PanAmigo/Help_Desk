<?php
    session_start();
    include (__DIR__.'/../Config/Database_config.php');
    $query = "SELECT * FROM Status_type";
    $data_statuses = $link->query($query);
?>