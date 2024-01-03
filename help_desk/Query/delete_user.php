<?php
include (__DIR__.'/../Config/Database_config.php');
session_start();

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = "DELETE User FROM User WHERE User.Id_User=".$_SESSION["userId"].";";
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