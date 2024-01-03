<?php
include (__DIR__.'/../Config/Database_config.php');
session_start();

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newClientName = $_POST['newClientName'];

    $query = "UPDATE Company SET name = '$newClientName' WHERE Id_company = ".$_SESSION['selected_id'].";";
    $result = $link->query($query);
    
    if ($result) {
        $response["success"] = true;
        $response["message"] = "Klient został zaktualizowany.";
    } else {
        $response["success"] = false;
        $response["message"] = "Wystąpił błąd podczas aktualizacji klienta: " . mysqli_error($link);
    }

    echo json_encode($response);
}
?>