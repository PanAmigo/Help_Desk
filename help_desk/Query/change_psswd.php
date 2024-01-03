<?php
header('Content-Type: application/json');
session_start();
include (__DIR__.'/../Config/Database_config.php');

$userId = $_SESSION["userId"];

function generateRandomPassword($length = 14) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%&@$#';
    $password = '';
    $charCount = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $charCount - 1)];
    };

    return $password;
}
$randomPassword = generateRandomPassword(14);
$password_hash = password_hash($randomPassword, PASSWORD_DEFAULT);


$query = "UPDATE User SET password = '$password_hash' WHERE Id_User = '$userId'";
$result = $link->query($query);
if ($result) {
    $response["success"] = true;
    $response["message"] = "Dane użytkownika zostały zaktualizowane pomyślnie.";
    $response["password"] = $randomPassword;
} else {
    $response["success"] = false;
    $response["message"] = "Wystąpił błąd podczas aktualizacji danych użytkownika: " . $link->error;
}

echo json_encode($response);
?>