<?php
    include (__DIR__.'/../Config/Database_config.php');
    session_start();
    $_SESSION["userId"] = $_POST["userId"];
    $query = "SELECT u.Login, u.Id_User as ID, u.Name as Name, ut.name AS user_type_name, c.name AS company_name FROM User AS u LEFT JOIN User_type AS ut ON u.Id_type = ut.Id_type LEFT JOIN Company AS c ON u.Id_company = c.Id_company WHERE u.Id_User = '".$_SESSION["userId"]."'";
    $data_user = $link->query($query);

    if ($data_user->num_rows == 1) {
        $row_user = mysqli_fetch_assoc($data_user);
        $response["success"] = true;
        $response["message"] = "poszło";
        $response["user_login"] = $row_user["Login"];
        $response["user_id"] = $row_user["ID"];
        $response["user_name"] = $row_user["Name"];
        $response["user_type"] = $row_user["user_type_name"];
        $response["user_company"] = $row_user["company_name"];
    } else {
        $response["success"] = false;
        $response["message"] = "błąd";
    }
    echo json_encode($response);
?>