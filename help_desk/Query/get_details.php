<?php
    include (__DIR__.'/../Config/Database_config.php');
    session_start();
    function se($link){ 
        if ( mysqli_errno($link) <> 0)
        {
          echo "<p><code>".mysqli_errno($link) .":". mysqli_error($link) ."</code></pre>\n"; 
        }
    }
    $ticket_id = $_SESSION['ticket_id'];
    $query = "SELECT 
    t.Id_ticket AS id_ticket, t.filing_date AS filing_date, t.last_update AS last_update, 
    r.Name AS reporter_name, COALESCE(o.Name, 'czeka na przypisanie') AS operator_name, s.status AS status_name, 
    c.name AS company_name, t.content AS ticket_content 
    FROM Ticket AS t 
    INNER JOIN User AS r ON t.Id_reporter = r.Id_User 
    LEFT JOIN User AS o ON t.Id_operator = o.Id_User 
    INNER JOIN Status_type AS s ON t.Id_status = s.Id_status 
    INNER JOIN Company AS c ON r.Id_company = c.Id_company WHERE t.Id_ticket = ".$ticket_id.";";
    $result = $link->query($query);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    }else {
        $errorMessage = "Błąd pobierania zgłoszenia. Spróbuj ponownie.";
    }
?> 