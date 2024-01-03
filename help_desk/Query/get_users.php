<?php
    session_start();
    include (__DIR__.'/../Config/Database_config.php');

    $query = "SELECT u.Id_User as ID, u.Name as Name, ut.name AS user_type_name, c.name AS company_name FROM User AS u LEFT JOIN User_type AS ut ON u.Id_type = ut.Id_type LEFT JOIN Company AS c ON u.Id_company = c.Id_company";
    $data_users = $link->query($query);


    $query = "SELECT c.Id_company, c.name AS company_name, COUNT(u.Id_User) AS users FROM Company AS c LEFT JOIN User AS u ON c.Id_company = u.Id_company GROUP BY c.Id_company, company_name;";
    $data_company = $link->query($query);

    $query = "SELECT c.Id_company, c.name AS company_name, COUNT(u.Id_User) AS users FROM Company AS c LEFT JOIN User AS u ON c.Id_company = u.Id_company GROUP BY c.Id_company, company_name;";
    $data_company2 = $link->query($query);

    $query = "SELECT c.Id_company, c.name AS company_name, COUNT(u.Id_User) AS users FROM Company AS c LEFT JOIN User AS u ON c.Id_company = u.Id_company GROUP BY c.Id_company, company_name;";
    $data_company3 = $link->query($query);
?>