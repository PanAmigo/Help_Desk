<?php
    session_start();
    include (__DIR__.'/../Config/Database_config.php');
    $query = "SELECT td.Id_details, td.response, td.date, u.name, td.Id_ticket
    FROM Ticket_details td
    JOIN User u ON td.id_user = u.Id_User
    WHERE td.Id_ticket = '".$_SESSION['ticket_id']."' ORDER BY td.date DESC;";
    $data_comments = $link->query($query);
?>