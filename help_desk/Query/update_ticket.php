<?php
    include (__DIR__.'/../Config/Database_config.php');
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ticket_id = $_SESSION['ticket_id'];
        $status = $_POST['newStatus'];
        $operator = $_POST['newOperator_Id'];
    
        $query = "UPDATE Ticket SET Id_status = '$status', Id_operator = '$operator', last_update = NOW() WHERE Id_ticket = '$ticket_id';";
        $_SESSION['query'] = $query;
        $result = $link->query($query);
        
        if ($result) {
            $response["success"] = true;
            $response["message"] = "Ticket został zaktualizowany.";
        } else {
            $response["success"] = false;
            $response["message"] = "Wystąpił błąd podczas aktualizacji zgłoszenia: " . mysqli_error($link);
        }

        echo json_encode($response);
    }
?>