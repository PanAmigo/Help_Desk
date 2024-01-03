<?php
    session_start();
    include (__DIR__.'/../Config/Database_config.php');
    $query = "SELECT u.Id_User, u.login, u.Name AS user_name, ut.name AS user_type, c.name AS company_name FROM User AS u LEFT JOIN User_type AS ut ON u.Id_type = ut.Id_type LEFT JOIN Company AS c ON u.Id_company = c.Id_company WHERE u.Id_User = '".$_SESSION['user_id']."';";
    $data_chosen_user = $link->query($query);

?>