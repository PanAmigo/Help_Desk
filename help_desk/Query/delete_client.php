<?php
include (__DIR__.'/../Config/Database_config.php');
session_start();

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = "DELETE Company, User FROM Company LEFT JOIN User ON Company.Id_company = User.Id_company WHERE Company.Id_company=".$_SESSION['selected_id'].";";
    $result = $link->query($query);
    if ($result) {
        $response["success"] = true;
        $response["message"] = "Klient został usunięty.";
    } else {
        $response["success"] = false;
        $response["message"] = "Wystąpił błąd podczas usuwania klienta: " . mysqli_error($link);
    }
}
echo json_encode($response);
?>