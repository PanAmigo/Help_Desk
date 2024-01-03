<?php
    include (__DIR__.'/../Config/Database_config.php');
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $content = $_POST["New_client"];
        $query="SELECT * FROM Company WHERE name='".$content."'";
        $result = $link->query($query);
        if ($result->num_rows == 1) {
            $errorMessage = "Taki klient jest już w bazie.";
        }
        else {
            $query = "INSERT INTO Company (name) VALUES ('".$content."')";
            $result = $link->query($query);
            if($result){
                header("Location: ".$_SERVER['PHP_SELF']);
            } else {
                $errorMessage = "Błąd dodawania zgłoszenia. Spróbuj ponownie.";
            }
        } 
    };
?> 