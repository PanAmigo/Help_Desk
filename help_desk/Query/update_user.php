<?php
session_start();
include (__DIR__.'/../Config/Database_config.php');

$userId = $_SESSION["userId"];
$userName = $_POST["userName"];
$userLogin = $_POST["userLogin"];
$userPermissions = $_POST["userPermissions"];
$userCompany = $_POST["userCompany"];

$query = "UPDATE User SET Name = '$userName', Login = '$userLogin', Id_type = '$userPermissions', Id_company = '$userCompany' WHERE Id_User = '$userId'";

if ($link->query($query) === TRUE) {
    $response["success"] = true;
    $response["message"] = "Dane użytkownika zostały zaktualizowane pomyślnie.";
} else {
    $response["success"] = false;
    $response["message"] = "Wystąpił błąd podczas aktualizacji danych użytkownika: " . $link->error;
}

echo json_encode($response);
?>