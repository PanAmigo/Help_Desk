<?php
    session_start();
    include (__DIR__.'/../Config/Database_config.php');
    if ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 2) {
        $query = 'SELECT Id_ticket as Numer_zgłoszenia, filing_date as Data_Zgłoszenia, Id_status as Status, last_update as Ostatnia_modyfikacja, reporter.Name FROM Ticket INNER JOIN User as reporter ON Ticket.Id_reporter = reporter.Id_User INNER JOIN Company ON reporter.Id_company = Company.Id_company ORDER BY filing_date DESC';
    }else{
        $query = 'SELECT Id_ticket as Numer_zgłoszenia, filing_date as Data_Zgłoszenia, Id_status as Status, last_update as Ostatnia_modyfikacja, reporter.Name FROM Ticket INNER JOIN User as reporter ON Ticket.Id_reporter = reporter.Id_User INNER JOIN Company ON reporter.Id_company = Company.Id_company WHERE Company.Id_company = '.$_SESSION['Id_company'].' ORDER BY filing_date DESC';
    }
    $data = $link->query($query);
?>
