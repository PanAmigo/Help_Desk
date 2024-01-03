<?php
    include (__DIR__.'/../Config/Database_config.php');
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $content = $_POST["comment"];
        $query = "INSERT INTO Ticket_details (`response`, `date`, `id_user`, `Id_ticket`) VALUES ('$content',NOW(),".$_SESSION['user_id'].",".$_SESSION['ticket_id'].")";
        $result = $link->query($query);
        if ($result) {
            $response["success"] = true;
            $response["message"] = "Ticket został zaktualizowany.";
        } else {
            $response["success"] = false;
            $response["message"] = "Wystąpił błąd podczas aktualizacji zgłoszenia: " . mysqli_error($link);
        }
    }
    echo json_encode($response);
?>