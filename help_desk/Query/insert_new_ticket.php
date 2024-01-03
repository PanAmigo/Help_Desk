<?php
    include (__DIR__.'/../Config/Database_config.php');
    session_start();
    function se($link){ 
        if ( mysqli_errno($link) <> 0)
        {
          echo "<p><code>".mysqli_errno($link) .":". mysqli_error($link) ."</code></pre>\n"; 
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $content = $_POST["Ticket"];
        $query = "INSERT INTO Ticket (Id_reporter, content) VALUES (".$_SESSION['user_id'].", '".$content."')";
        $result = $link->query($query);
        if($result){
            header("location: ../Pages/Panel.php");
        } else {
            $errorMessage = "Błąd dodawania zgłoszenia. Spróbuj ponownie.";
        }
    }
?>
